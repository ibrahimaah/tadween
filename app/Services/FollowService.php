<?php

namespace App\Services;

use App\Models\Follow;
use App\Traits\CacheClearable;
use Exception; 

class FollowService
{
    use CacheClearable;
    public function approve_follow_request($id)
    {
        try 
        {
            $request = Follow::findOrFail($id);
            $request->is_pending = false;
            if($request->save())
            {
                $this->clear_posts_cache();
                return ['code' => 1, 'data' => true];
            }
            else 
            {
                throw new Exception('Can not approve the request , something went wrong');
            }            
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    public function deny_follow_request($id)
    {
        try 
        {
            $request = Follow::findOrFail($id);  
            if($request->delete())
            {
                return ['code' => 1, 'data' => true];
            }
            else 
            {
                throw new Exception('Can not deny the request , something went wrong');
            }            
        } 
        catch (Exception $ex) 
        {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
}
