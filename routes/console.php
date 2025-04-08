<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

//force-delete-archive-users

// Schedule::command('force-delete-archive-users')->daily();
Schedule::command('force-delete-archive-users')->everyMinute();

