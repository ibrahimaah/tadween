<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendGiftRequest;
use App\Models\Gift;
use App\Services\GiftService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{ 

    public function __construct(protected GiftService $giftService){}

    // Show all available gifts (for sending)
    public function index()
    {
        // if(request()->ajax())
        // {
            $res_getGifts = $this->giftService->getGifts();
            if($res_getGifts['code'] == 0)
            {
                return response()->json(['success' => false,'message'=>$res_getGifts['msg']]);
            }
            return response()->json(['success' => true,'data'=>$res_getGifts['data']]);
        // }
    }

    public function send(SendGiftRequest $request)
    {
        $data = $request->validated();
        $data['sender_id'] = Auth::id();
        $result = $this->giftService->sendGift($data['sender_id'], $data['receiver_id'], $data['gift_id'], $data['userGiftVisibility']);
    
        if ($result['code'] === 1) {
            return response()->json(['success' => true, 'message' =>  __('gifts.gift_sent_success')]);
        } else {
            return response()->json(['success' => false, 'message' =>  $result['msg']]);
        }
    }

    // Show received gifts for a user
    public function received($userId)
    {
        $viewerId = Auth::id();
        $receivedGifts = $this->giftService->getReceivedGifts($userId, $viewerId);

        return view('gifts.received', compact('receivedGifts'));
    }

    public function getGiftById($id)
    {
        $res = $this->giftService->getGiftById($id);
        if($res['code'] == 0) 
        {
            return response()->json(['success' => false, 'message' => $res['msg']]);
        }
        return response()->json(['success' => true, 'data' => $res['data']]);
    }

    public function getUserGifts($username)
    {
        

        return view('profile.gifts.index');
    }

    
}
