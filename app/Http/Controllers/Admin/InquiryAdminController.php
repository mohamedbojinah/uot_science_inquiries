<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Faq;
use App\Models\Inquiry;
use App\Models\InquiryCategory;
use App\Models\InquiryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryAdminController extends Controller
{
    /**
     * Display a listing of inquiries with filters.
     */
    public function index(Request $request)
    {
        $departments = Department::where('is_active', true)->orderBy('name_ar')->get();
        $categories = InquiryCategory::where('is_active', true)->orderBy('display_order')->get();

        $query = Inquiry::with(['department', 'category', 'repliedBy']);

        // Role restriction: if department head, restrict or allow selection
        $user = Auth::user();
        if ($user->role === 'department_head' && $user->department_id && !$request->filled('department_id')) {
            $query->where('department_id', $user->department_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('search')) {
            $kw = '%' . trim($request->search) . '%';
            $query->where(function ($q) use ($kw) {
                $q->where('tracking_code', 'like', $kw)
                  ->orWhere('full_name', 'like', $kw)
                  ->orWhere('national_id_or_student_id', 'like', $kw)
                  ->orWhere('email', 'like', $kw)
                  ->orWhere('phone', 'like', $kw)
                  ->orWhere('subject', 'like', $kw);
            });
        }

        $inquiries = $query->latest()->paginate(15)->withQueryString();

        return view('admin.inquiries.index', compact('inquiries', 'departments', 'categories'));
    }

    /**
     * Display inquiry detail and response interface.
     */
    public function show(int $id)
    {
        $inquiry = Inquiry::with(['department', 'category', 'repliedBy', 'logs.user'])->findOrFail($id);
        $departments = Department::where('is_active', true)->get();

        // If newly opened by staff and still 'new', mark as 'in_review'
        if ($inquiry->status === 'new') {
            $inquiry->update(['status' => 'in_review']);
            InquiryLog::create([
                'inquiry_id' => $inquiry->id,
                'user_id' => Auth::id(),
                'action' => 'status_updated',
                'title' => 'تم فتح ومراجعة الاستفسار',
                'details' => 'تم تغيير حالة الاستفسار إلى (قيد المراجعة) بواسطة ' . Auth::user()->name,
            ]);
        }

        return view('admin.inquiries.show', compact('inquiry', 'departments'));
    }

    /**
     * Submit an official answer to the inquiry.
     */
    public function reply(Request $request, int $id)
    {
        $inquiry = Inquiry::findOrFail($id);

        $request->validate([
            'reply_message' => 'required|string|min:5',
            'publish_to_faq' => 'nullable|boolean',
            'faq_question' => 'nullable|string',
        ], [
            'reply_message.required' => 'يرجى كتابة نص الإجابة أو الرد الرسمي.',
        ]);

        $inquiry->update([
            'reply_message' => $request->reply_message,
            'status' => 'answered',
            'replied_by_user_id' => Auth::id(),
            'replied_at' => now(),
            'is_public_faq' => $request->boolean('publish_to_faq'),
            'faq_question' => $request->faq_question ?? $inquiry->subject,
            'faq_answer' => $request->reply_message,
        ]);

        // If requested to publish as FAQ
        if ($request->boolean('publish_to_faq')) {
            Faq::updateOrCreate(
                [
                    'question' => $request->faq_question ?? $inquiry->subject,
                ],
                [
                    'department_id' => $inquiry->department_id,
                    'category_id' => $inquiry->category_id,
                    'answer' => $request->reply_message,
                    'is_published' => true,
                ]
            );
        }

        // Add log
        InquiryLog::create([
            'inquiry_id' => $inquiry->id,
            'user_id' => Auth::id(),
            'action' => 'replied',
            'title' => 'تم إرسال الرد الرسمي على الاستفسار',
            'details' => 'قام ' . Auth::user()->name . ' بإرسال الإجابة واعتماد الحالة (تم الرد).',
        ]);

        return redirect()->route('admin.inquiries.show', $inquiry->id)->with('success', 'تم حفظ الرد واعتماده بنجاح! يمكن لمقدم الطلب الآن رؤية الإجابة برقم التتبع.');
    }

    /**
     * Update inquiry status, department re-assignment, or internal notes.
     */
    public function updateStatus(Request $request, int $id)
    {
        $inquiry = Inquiry::findOrFail($id);

        $request->validate([
            'status' => 'required|in:new,in_review,answered,closed',
            'department_id' => 'required|exists:departments,id',
            'internal_notes' => 'nullable|string',
        ]);

        $oldStatus = $inquiry->status;
        $oldDepId = $inquiry->department_id;

        $inquiry->update([
            'status' => $request->status,
            'department_id' => $request->department_id,
            'internal_notes' => $request->internal_notes,
        ]);

        $changes = [];
        if ($oldStatus !== $request->status) {
            $changes[] = "تغيير الحالة إلى " . $inquiry->status_label;
        }
        if ($oldDepId != $request->department_id) {
            $changes[] = "إعادة التوجيه إلى " . $inquiry->department->name_ar;
        }

        if (!empty($changes)) {
            InquiryLog::create([
                'inquiry_id' => $inquiry->id,
                'user_id' => Auth::id(),
                'action' => 'status_updated',
                'title' => 'تحديث بيانات الاستفسار',
                'details' => implode(' | ', $changes) . ' بواسطة ' . Auth::user()->name,
            ]);
        }

        return redirect()->route('admin.inquiries.show', $inquiry->id)->with('success', 'تم تحديث حالة الاستفسار بنجاح.');
    }

    /**
     * Delete inquiry (admin/dean only).
     */
    public function destroy(int $id)
    {
        $user = Auth::user();
        if (!$user->isAdmin()) {
            abort(403, 'لا تملك صلاحية حذف الاستفسارات.');
        }

        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('success', "تم حذف الاستفسار بنجاح.");
    }

    /**
     * Export inquiries to CSV (with UTF-8 BOM for Arabic support).
     */
    public function exportCsv(Request $request)
    {
        $inquiries = Inquiry::with(['department', 'category', 'repliedBy'])->latest()->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="inquiries_uot_science_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($inquiries) {
            $file = fopen('php://output', 'w');
            // Write UTF-8 BOM for Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, [
                'الرقم المرجعي',
                'صفة مقدم الطلب',
                'الاسم الكامل',
                'رقم القيد / الرقم الوطني',
                'البريد الإلكتروني',
                'رقم الهاتف',
                'القسم الأكاديمي',
                'التصنيف',
                'الأولوية',
                'الموضوع',
                'الحالة',
                'تاريخ التقديم',
                'تاريخ الرد',
                'الموظف الذي رد',
            ]);

            foreach ($inquiries as $item) {
                fputcsv($file, [
                    $item->tracking_code,
                    $item->sender_type_label,
                    $item->full_name,
                    $item->national_id_or_student_id ?? '-',
                    $item->email,
                    $item->phone,
                    $item->department->name_ar ?? '-',
                    $item->category->name_ar ?? '-',
                    $item->priority_label,
                    $item->subject,
                    $item->status_label,
                    $item->created_at->format('Y-m-d H:i'),
                    $item->replied_at ? $item->replied_at->format('Y-m-d H:i') : '-',
                    $item->repliedBy->name ?? '-',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
