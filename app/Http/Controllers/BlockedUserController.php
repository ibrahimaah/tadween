<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\BlockUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockedUserController extends Controller
{
    public function __construct(private BlockUserService $blockUserService)
    {
        
    }

    public function block(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required'
        ]);

        $username = $validated['username'];
        $blocked_user = User::where('username',$username)->first();

        $res_block = $this->blockUserService->block($blocked_user->id);

        if ($res_block['code'] == 0) 
        {
           dd($res_block['msg']);
        }

        return redirect()->back();
    }

    public function unblock(Request $request)
    {
     
        $validated = $request->validate([
            'username' => 'required'
        ]);

        $username = $validated['username'];
        $blocked_user = User::where('username',$username)->first();

        $res_unblock = $this->blockUserService->unblock($blocked_user->id);

        if ($res_unblock['code'] == 0) 
        {
           dd($res_unblock['msg']);
        }

        return redirect()->back();
    }
}
