<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ForceDeleteArchiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'force-delete-archive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete each archived user after 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date_passed = Carbon::now()->subDays(30);
        // $date_passed = Carbon::now()->subMinute();
        // $date_passed = Carbon::now()->subHour();

        $users_ids = User::onlyTrashed()
                         ->where('is_scheduled_for_deletion', true)
                         ->where('deleted_at', '<=', $date_passed)
                         ->pluck('id')
                         ->toArray();


        if(!empty($users_ids))
        {
            foreach($users_ids as $user_id)
            {
                // info($user_id);
                $res_removeUser = (new UserService)->removeUser($user_id);
                if($res_removeUser['code'] == 0)
                {
                    info('user_id = '.$user_id.' error in force delete '.$res_removeUser['msg']);
                }
            }
            info('force-delete-archive-users is done');
        }
        else 
        {
            info('force-delete-archive-users is done with no archive users');      
        }
          
    }
}
