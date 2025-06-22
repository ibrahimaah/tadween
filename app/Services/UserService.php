<?php

namespace App\Services;

use App\Enums\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function archiveUser($id,$pwd)
    {
        try 
        {
            $user = User::findOrFail($id);

            if($user->role !== Role::USER->value)
            {
                throw new Exception(__('settings.must_be_user'));
            }

            if (!Hash::check($pwd, $user->password)) 
            {
                throw new Exception(__('settings.password_now_incorrect'));
            }

            Auth::logout();
      
            $user->is_scheduled_for_deletion = true;
            $user->save();
            
            if($user->delete())
            {
                return ['code' => 1, 'data' => true];
            }
             
        }
        catch(Exception $ex)
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    public function removeUser($id)
    {
        try 
        {
            $user = User::with(['profile', 'posts', 'replies'])
            ->withTrashed() // Include trashed (soft-deleted) users
            ->findOrFail($id);


            DB::beginTransaction();
 
            // Collect all related files to delete
            $userProfile = $user->profile;
            $posts = $user->posts;
            $replies = $user->replies;
            
            // Delete files for user profile
            if ($userProfile) 
            {
                if ($userProfile->background_image) 
                {
                    $backgroundImagePath = public_path('background_images/' . basename($userProfile->background_image));  // تحديد المسار الكامل للصورة
                    if (file_exists($backgroundImagePath)) 
                    {
                        unlink($backgroundImagePath);  // حذف الصورة إذا كانت موجودة
                    }
                }
                if ($userProfile->cover_image) 
                {
                    $coverImagePath = public_path('cover_images/' . basename($userProfile->cover_image));  // تحديد المسار الكامل للصورة
                    if (file_exists($coverImagePath)) 
                    {
                        unlink($coverImagePath);  // حذف الصورة إذا كانت موجودة
                    }
                }
            }

            // Delete files for posts
            foreach ($posts as $post) 
            {
                if ($post->image) 
                {
                    $imagePath = public_path('posts/' . basename($post->image));  // تحديد المسار الكامل للصورة
                    if (file_exists($imagePath)) 
                    {
                        unlink($imagePath);  // حذف الصورة إذا كانت موجودة
                    }
                }
            }

            // Delete files for replies
            foreach ($replies as $reply) 
            {
                if ($reply->reply_image) 
                {
                    $replyImagePath = public_path('replies/' . basename($reply->reply_image));  // تحديد المسار الكامل للصورة
                    if (file_exists($replyImagePath)) 
                    {
                        unlink($replyImagePath);  // حذف الصورة إذا كانت موجودة
                    }
                }
            }
 
            // Delete the user's account
            $user->forceDelete();
            // Commit the transaction
            DB::commit();
    
           
            return ['code' => 1, 'data' => true];
            
             
        }
        catch(Exception $ex)
        {
            DB::rollBack();
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    public function getUserByUsername($username)
    {
        try 
        { 
            $user = User::where('username', $username)->first();

            if(!$user)
            {
                throw new Exception(__('profile.profile_user_not_found'));
            }

            return ['code' => 1, 'data' => $user];
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }

    public function getTransferWalletUsers()
    {
        try 
        {
            $data = User::select('id','username')
                        ->where('role','user')
                        ->where ('is_ban','no')
                        ->where('id','!=',Auth::id())
                        ->get();
                        
            return ['code' => 1, 'data' => $data];
        }
        catch(Exception $ex)
        {
            return ['code' => 0 , 'msg' => $ex->getMessage()];
        }
    }

    
}