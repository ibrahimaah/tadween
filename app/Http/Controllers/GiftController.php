<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendGiftRequest;
use App\Services\GiftService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{ 

    public function __construct(protected GiftService $giftService){}

    // Show all available gifts (for sending)
    public function index()
    {
        $gifts = $this->giftService->getAllGifts();
        return view('gifts.index', compact('gifts'));
    }

    public function send(SendGiftRequest $request)
    {
        $senderId = Auth::id();
        $receiverId = $request->receiver_id;
        $giftId = $request->gift_id;
        $visibility = $request->visibility;
    
        $result = $this->giftService->sendGift($senderId, $receiverId, $giftId, $visibility);
    
        if ($result['code'] === 1) {
            return back()->with('success', __('gifts.gift_sent_success'));
        } else {
            return back()->with('error', $result['msg']);
        }
    }

    // Show received gifts for a user
    public function received($userId)
    {
        $viewerId = Auth::id();
        $receivedGifts = $this->giftService->getReceivedGifts($userId, $viewerId);

        return view('gifts.received', compact('receivedGifts'));
    }
}
