<?php

namespace App\Http\Controllers;
 
use App\Models\User; 
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Validator; 

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
        
    }
     //Delete My Account User
     public function delete(Request $request)
     {
        $validator = Validator::make($request->all(), [
            'account_password' => 'required'
        ]);

        if ($validator->fails()) 
        {
            return response()->json([
                'success' => false,
                'message' => __('validation.required', ['attribute' => 'account password']),
            ], 422);
        }
        
        $res_archiveUser = $this->userService->archiveUser(Auth::id(),$request->account_password);

        if($res_archiveUser['code'] == 0)
        {
            return response()->json([
                'success' => false,
                'message' => $res_archiveUser['msg']
            ], 200);
        }

        return response()->json([
        'success' => true,
        'message' => __('settings.delete_account_temp')
    ]);

     }
}
