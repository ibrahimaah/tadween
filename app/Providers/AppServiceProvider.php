<?php

namespace App\Providers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $locale = Cookie::get('locale', 'ar');  // إذا لم تكن موجودة، يتم تعيين اللغة الافتراضية إلى 'ar'
        App::setLocale($locale);  // تعيين اللغة

        
         // استخدام قوالب Bootstrap 5 لتقسيم الصفحات
        Paginator::useBootstrapFive();
    }
}
