<?php

use App\Models\Department;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| موقع استفسارات كلية العلوم - جامعة طرابلس
|--------------------------------------------------------------------------
*/

// 1. الصفحة الرئيسية: نموذج بسيط لإدخال واستقبال الاستفسارات
Route::get('/', function () {
    $departments = Department::where('is_active', true)->orderBy('name_ar')->get();
    return view('simple_inquiry', compact('departments'));
})->name('home');

// 2. معالجة وحفظ الاستفسار في قاعدة البيانات
Route::post('/submit-inquiry', function (Request $request) {
    $validated = $request->validate([
        'full_name' => 'required|string|max:150',
        'contact' => 'required|string|max:150',
        'department_id' => 'nullable|exists:departments,id',
        'message' => 'required|string|min:5',
    ], [
        'full_name.required' => 'يرجى كتابة اسمك الكامل.',
        'contact.required' => 'يرجى إدخال البريد الإلكتروني أو رقم الهاتف للتواصل.',
        'message.required' => 'يرجى كتابة نص السؤال أو الاستفسار.',
        'message.min' => 'يرجى كتابة استفسار واضح (5 أحرف على الأقل).',
    ]);

    // Check if contact is email or phone
    $email = filter_var($validated['contact'], FILTER_VALIDATE_EMAIL) ? $validated['contact'] : null;
    $phone = !$email ? $validated['contact'] : null;

    $trackingCode = 'UOT-SCI-' . date('Y') . '-' . rand(1000, 9999);

    $inquiry = Inquiry::create([
        'tracking_code' => $trackingCode,
        'sender_type' => 'student',
        'full_name' => $validated['full_name'],
        'email' => $email ?? $validated['contact'],
        'phone' => $phone ?? $validated['contact'],
        'department_id' => $validated['department_id'],
        'subject' => \Illuminate\Support\Str::limit($validated['message'], 60, '...'),
        'message' => $validated['message'],
        'status' => 'new',
        'ip_address' => $request->ip(),
    ]);

    return back()->with('success_inquiry', [
        'name' => $inquiry->full_name,
        'code' => $inquiry->tracking_code,
        'department' => $inquiry->department ? $inquiry->department->name_ar : 'عام / إدارة الكلية',
    ]);
})->name('inquiry.submit');

// 3. صفحة بسيطة لعرض جميع الاستفسارات المخزنة في قاعدة البيانات
Route::get('/inquiries', function () {
    $inquiries = Inquiry::with('department')->latest()->paginate(20);
    $totalCount = Inquiry::count();
    return view('inquiries_list', compact('inquiries', 'totalCount'));
})->name('inquiries.list');

// 4. حذف استفسار (لتنظيف البيانات إذا لزم)
Route::delete('/inquiries/{id}', function ($id) {
    $inquiry = Inquiry::findOrFail($id);
    $inquiry->delete();
    return back()->with('deleted', 'تم حذف الاستفسار بنجاح.');
})->name('inquiries.delete');

/*
|--------------------------------------------------------------------------
| مسارات التشغيل على منصة ريندر (مثل مشروع المستشفى hospital_equipment بالزبط)
|--------------------------------------------------------------------------
*/
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
            "<div style='font-family: Cairo, Tahoma, sans-serif; direction: rtl; text-align: center; padding: 40px 20px; background: #f0fdf4; color: #166534; border: 2px solid #bbf7d0; border-radius: 12px; max-width: 600px; margin: 50px auto; box-shadow: 0 10px 25px rgba(0,0,0,0.06);'>
                <h2 style='margin-bottom: 12px; color: #15803d;'>✅ تم تهيئة قاعدة البيانات بنجاح على منصة Render!</h2>
                <p style='font-size: 16px; color: #374151; line-height: 1.8;'>تم تجهيز قاعدة البيانات لـ <strong>كلية العلوم - جامعة طرابلس</strong> بنجاح وأصبح الموقع جاهزاً لاستقبال الاستفسارات وتخزينها.</p>
                <div style='margin-top: 25px;'>
                    <a href='" . url('/') . "' style='display: inline-block; background: #0f2b48; color: white; padding: 12px 28px; text-decoration: none; border-radius: 8px; font-weight: bold;'>الانتقال لصفحة إدخال الاستفسار ➔</a>
                    <a href='" . url('/inquiries') . "' style='display: inline-block; background: #0284c7; color: white; padding: 12px 28px; text-decoration: none; border-radius: 8px; font-weight: bold; margin-right: 8px;'>عرض الاستفسارات المخزنة</a>
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
