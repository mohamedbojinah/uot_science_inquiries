<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Inquiry;
use App\Models\InquiryCategory;
use App\Models\InquiryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InquiryController extends Controller
{
    /**
     * Show form to submit a new inquiry.
     */
    public function create()
    {
        $departments = Department::where('is_active', true)->orderBy('id')->get();
        $categories = InquiryCategory::where('is_active', true)->orderBy('display_order')->get();

        return view('inquiries.create', compact('departments', 'categories'));
    }

    /**
     * Store new inquiry in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_type' => 'required|in:student,alumnus,visitor,faculty_staff',
            'full_name' => 'required|string|min:3|max:150',
            'national_id_or_student_id' => 'nullable|string|max:50',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:30',
            'department_id' => 'required|exists:departments,id',
            'category_id' => 'nullable|exists:inquiry_categories,id',
            'priority' => 'required|in:normal,urgent',
            'subject' => 'required|string|min:5|max:200',
            'message' => 'required|string|min:10',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ], [
            'sender_type.required' => 'يرجى اختيار صفة مقدم الاستفسار.',
            'full_name.required' => 'يرجى كتابة الاسم الرباعي كاملاً.',
            'email.required' => 'يرجى إدخال بريدك الإلكتروني الصحيح لتلقي الرد.',
            'phone.required' => 'يرجى إدخال رقم هاتفك للتواصل.',
            'department_id.required' => 'يرجى تحديد القسم الأكاديمي المختص.',
            'subject.required' => 'يرجى كتابة موضوع أو عنوان الاستفسار.',
            'message.required' => 'يرجى كتابة تفاصيل الاستفسار أو السؤال.',
            'attachment.max' => 'حجم الملف المرفق يجب ألا يتجاوز 5 ميجابايت.',
            'attachment.mimes' => 'أنواع الملفات المسموحة هي: PDF, JPG, PNG, DOCX.',
        ]);

        $trackingCode = Inquiry::generateTrackingCode();
        $attachmentPath = null;
        $attachmentName = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentName = $file->getClientOriginalName();
            $attachmentPath = $file->store('attachments', 'public');
        }

        $inquiry = Inquiry::create([
            'tracking_code' => $trackingCode,
            'sender_type' => $validated['sender_type'],
            'full_name' => $validated['full_name'],
            'national_id_or_student_id' => $validated['national_id_or_student_id'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'department_id' => $validated['department_id'],
            'category_id' => $validated['category_id'],
            'priority' => $validated['priority'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'attachment_path' => $attachmentPath,
            'attachment_name' => $attachmentName,
            'status' => 'new',
            'ip_address' => $request->ip(),
        ]);

        // Create log record
        InquiryLog::create([
            'inquiry_id' => $inquiry->id,
            'action' => 'created',
            'title' => 'تم استلام الاستفسار بنجاح وتوليد الرقم المرجعي',
            'details' => 'تم توجيه الاستفسار آلياً إلى ' . $inquiry->department->name_ar,
        ]);

        return redirect()->route('inquiries.success', ['code' => $inquiry->tracking_code]);
    }

    /**
     * Show success page after submitting inquiry.
     */
    public function success(string $code)
    {
        $inquiry = Inquiry::with(['department', 'category'])->where('tracking_code', $code)->firstOrFail();
        return view('inquiries.success', compact('inquiry'));
    }

    /**
     * Track an inquiry by code.
     */
    public function track(Request $request, ?string $code = null)
    {
        $trackingCode = trim($code ?? $request->input('tracking_code', ''));

        if (!$trackingCode) {
            return view('inquiries.track');
        }

        $inquiry = Inquiry::with(['department', 'category', 'repliedBy', 'logs'])
            ->where('tracking_code', $trackingCode)
            ->first();

        if (!$inquiry) {
            return view('inquiries.track', [
                'searchedCode' => $trackingCode,
                'errorMessage' => 'عذراً، لم يتم العثور على أي استفسار مسجل بالرقم المرجعي (' . $trackingCode . '). يرجى التأكد من صحة الرمز وإعادة المحاولة.',
            ]);
        }

        // Mark viewed by student if answered
        if ($inquiry->status === 'answered' && !$inquiry->viewed_by_student_at) {
            $inquiry->update(['viewed_by_student_at' => now()]);
        }

        return view('inquiries.track_result', compact('inquiry'));
    }
}
