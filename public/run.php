<?php

// التأكد من أنك في بيئة Laravel
if (file_exists(__DIR__ . '/../bootstrap/app.php')) {
    // تحميل إعدادات Laravel
    require __DIR__ . '/../vendor/autoload.php'; // تأكد من المسار الصحيح
    $app = require_once __DIR__ . '/../bootstrap/app.php'; // تأكد من المسار الصحيح
} else {
    die("Laravel not found in the given path.");
}

use Illuminate\Support\Facades\Artisan;

// تحقق من مفتاح سري لتأمين الوصول
if (isset($_GET['key']) && $_GET['key'] === 'mySecureKey123') {
    try {
        // تهيئة التطبيق يدويًا
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        $kernel->bootstrap();

        // تنظيف الكاش
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Artisan::call('event:clear');
        

        // إعادة تحميل كاش المسارات
        Artisan::call('route:cache');  // إضافة هذا السطر

        echo "تم تنظيف الكاش والمسارات والإعدادات بنجاح!";
    } catch (Exception $e) {
        echo "حدث خطأ أثناء تنفيذ الأمر: " . $e->getMessage();
    }
} else {
    echo "ليس لديك صلاحية لتنفيذ هذه الأوامر.";
}

?>
