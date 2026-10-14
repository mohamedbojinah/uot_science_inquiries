<?php

use App\Models\Department;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| موقع كلية العلوم - جامعة طرابلس (بوابة الزوار + لوحة الإدارة)
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. رابط الزوار: عرض تعريفي بكلية العلوم واستقبال أي سؤال أو استفسار
// =========================================================================
Route::get('/', function () {
    $departments = Department::where('is_active', true)->orderBy('name_ar')->get();
    return view('visitor_showcase', compact('departments'));
})->name('visitors');

// إرسال وحفظ استفسار الزائر في قاعدة البيانات
Route::post('/submit-inquiry', function (Request $request) {
    $validated = $request->validate([
        'full_name' => 'nullable|string|max:150',
        'contact' => 'nullable|string|max:150',
        'sender_type' => 'nullable|string|in:student,freshman,alumnus,parent,other',
        'department_id' => 'nullable|exists:departments,id',
        'message' => 'required|string|min:3',
    ], [
        'message.required' => 'يرجى كتابة نص السؤال أو الاستفسار.',
        'message.min' => 'يرجى كتابة استفسار واضح (3 أحرف على الأقل).',
    ]);

    $fullName = !empty(trim($validated['full_name'] ?? '')) ? trim($validated['full_name']) : 'زائر';
    $contact = !empty(trim($validated['contact'] ?? '')) ? trim($validated['contact']) : null;

    $email = ($contact && filter_var($contact, FILTER_VALIDATE_EMAIL)) ? $contact : null;
    $phone = ($contact && !$email) ? $contact : null;

    $trackingCode = 'UOT-SCI-' . date('Y') . '-' . rand(1000, 9999);

    $inquiry = Inquiry::create([
        'tracking_code' => $trackingCode,
        'sender_type' => $validated['sender_type'] ?? 'other',
        'full_name' => $fullName,
        'email' => $email,
        'phone' => $phone,
        'department_id' => $validated['department_id'] ?? null,
        'subject' => \Illuminate\Support\Str::limit($validated['message'], 60, '...'),
        'message' => $validated['message'],
        'status' => 'new',
        'ip_address' => $request->ip(),
    ]);

    return redirect('/#inquiry')->with('success_inquiry', [
        'name' => $inquiry->full_name,
        'code' => $inquiry->tracking_code,
        'department' => $inquiry->department ? $inquiry->department->name_ar : 'عام / إدارة الكلية',
    ]);
})->name('inquiry.submit');


// =========================================================================
// 2. رابط الإدارة: مخصص لإدارة الكلية لاستعراض وفحص وحذف الاستفسارات
// =========================================================================
Route::get('/admin', function (Request $request) {
    $departments = Department::where('is_active', true)->orderBy('name_ar')->get();

    $query = Inquiry::with('department')->latest();

    // البحث بالاسم أو وسيلة التواصل أو الرقم المرجعي
    if ($request->filled('search')) {
        $kw = '%' . trim($request->search) . '%';
        $query->where(function ($q) use ($kw) {
            $q->where('full_name', 'like', $kw)
              ->orWhere('email', 'like', $kw)
              ->orWhere('phone', 'like', $kw)
              ->orWhere('tracking_code', 'like', $kw)
              ->orWhere('message', 'like', $kw);
        });
    }

    // التصفية حسب القسم
    if ($request->filled('department_id')) {
        $query->where('department_id', $request->department_id);
    }

    $inquiries = $query->paginate(20)->withQueryString();

    $totalCount = Inquiry::count();
    $todayCount = Inquiry::whereDate('created_at', today())->count();
    $studentCount = Inquiry::where('sender_type', 'student')->count();
    $visitorCount = Inquiry::whereIn('sender_type', ['freshman', 'parent', 'other'])->count();

    return view('admin_inquiries', compact(
        'inquiries',
        'departments',
        'totalCount',
        'todayCount',
        'studentCount',
        'visitorCount'
    ));
})->name('admin');

// تحويل /inquiries إلى /admin لسهولة الوصول
Route::get('/inquiries', function () {
    return redirect()->route('admin');
});

// حذف استفسار من قبل الإدارة
Route::delete('/admin/inquiries/{id}', function ($id) {
    $inquiry = Inquiry::findOrFail($id);
    $code = $inquiry->tracking_code;
    $inquiry->delete();
    return back()->with('deleted', "تم حذف الاستفسار ({$code}) بنجاح من قاعدة البيانات.");
})->name('admin.delete');

// تصدير كشف الاستفسارات بصيغة Excel / CSV
Route::get('/admin/export', function () {
    $inquiries = Inquiry::with('department')->latest()->get();

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="uot_science_inquiries_' . date('Y-m-d') . '.csv"',
    ];

    $callback = function () use ($inquiries) {
        $file = fopen('php://output', 'w');
        // UTF-8 BOM for Microsoft Excel
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($file, [
            'الرقم المرجعي',
            'الاسم الكامل',
            'الصفة',
            'وسيلة التواصل',
            'القسم المختص',
            'نص الاستفسار',
            'تاريخ وتوقيت الإرسال',
        ]);

        foreach ($inquiries as $item) {
            fputcsv($file, [
                $item->tracking_code,
                $item->full_name,
                $item->sender_type_label,
                $item->email ?? $item->phone,
                $item->department ? $item->department->name_ar : 'عام / الإدارة',
                $item->message,
                $item->created_at->format('Y-m-d H:i'),
            ]);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
})->name('admin.export');


// =========================================================================
// 3. مسارات التشغيل والتهيئة السحابية على منصة Render
// =========================================================================
Route::get('/setup-db', function () {
    try {
        if (config('database.default') === 'sqlite') {
            $dbPath = config('database.connections.sqlite.database');
            if ($dbPath && !file_exists($dbPath) && $dbPath !== ':memory:') {
                $dir = dirname($dbPath);
                if (!is_dir($dir)) {
                    @mkdir($dir, 0755, true);
                }
                @touch($dbPath);
            }
        }

        Artisan::call('migrate:fresh', [
            '--seed' => true,
            '--force' => true
        ]);

        return response(
            "<div style='font-family: Cairo, Tahoma, sans-serif; direction: rtl; text-align: center; padding: 40px 20px; background: #f0fdf4; color: #166534; border: 2px solid #bbf7d0; border-radius: 12px; max-width: 650px; margin: 50px auto; box-shadow: 0 10px 25px rgba(0,0,0,0.06);'>
                <h2 style='margin-bottom: 12px; color: #15803d;'>✅ تم تهيئة قاعدة البيانات بنجاح على منصة Render!</h2>
                <p style='font-size: 16px; color: #374151; line-height: 1.8;'>تم تجهيز قاعدة البيانات لـ <strong>كلية العلوم - جامعة طرابلس</strong> بنجاح. أصبحت الروابط جاهزة للعمل فوراً:</p>
                <div style='margin-top: 25px; display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;'>
                    <a href='" . url('/') . "' style='display: inline-block; background: #0f2b48; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold;'>🌐 رابط الزوار (العرض التعريفي والاستفسار)</a>
                    <a href='" . route('admin') . "' style='display: inline-block; background: #0284c7; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold;'>🔐 رابط الإدارة (عرض الاستفسارات)</a>
                </div>
            </div>"
        );
    } catch (\Throwable $e) {
        return response("حدث خطأ أثناء تهيئة قاعدة البيانات: " . $e->getMessage(), 500);
    }
});

Route::get('/migrate-only', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return response("<div style='direction: rtl; text-align: center; padding: 30px;'>تم تحديث الجداول بنجاح! <a href='/'>العودة</a></div>");
    } catch (\Throwable $e) {
        return response("حدث خطأ: " . $e->getMessage(), 500);
    }
});
