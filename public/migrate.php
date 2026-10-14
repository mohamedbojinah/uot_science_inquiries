<?php

use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

try {
    // Touch database if sqlite
    $sqlitePath = __DIR__.'/../database/database.sqlite';
    if (!file_exists($sqlitePath)) {
        @touch($sqlitePath);
    }

    $kernel->call('migrate', [
        '--seed' => true,
        '--force' => true
    ]);
    echo "<div style='font-family: Cairo, Tahoma, sans-serif; direction: rtl; text-align: center; padding: 40px; background: #ecfdf5; color: #065f46; border-radius: 10px; max-width: 600px; margin: 50px auto;'>
            <h2>✅ تم تحديث وتهيئة قاعدة البيانات بنجاح!</h2>
            <p><a href='/' style='color: #0284c7; font-weight: bold;'>الانتقال لصفحة الزوار</a> | <a href='/admin' style='color: #0284c7; font-weight: bold;'>الانتقال لصفحة الإدارة</a></p>
          </div>";
} catch (\Throwable $e) {
    echo "<div style='font-family: Cairo, Tahoma, sans-serif; direction: rtl; padding: 30px; background: #fef2f2; color: #991b1b; max-width: 700px; margin: 40px auto; border-radius: 10px;'>
            <h2>حدث خطأ أثناء تشغيل الميجريشن:</h2>
            <pre style='direction: ltr; text-align: left; background: white; padding: 15px; border-radius: 6px;'>" . htmlspecialchars($e->getMessage()) . "</pre>
          </div>";
}
