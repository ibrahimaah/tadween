<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendGiftRequest;
use App\Models\Gift;
use App\Models\UserGift;
use App\Services\GiftService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{ 

    public function __construct(protected GiftService $giftService,protected UserService $userService){}

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
        
        $senderId = Auth::id(); 

        $result = $this->giftService->sendGift($senderId,$data);
    
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

    public function getUserGifts(string $username)
    { 
        if (!request()->ajax()) {
            return view('profile.gifts.index');
        }
    
        $result = $this->userService->getUserByUsername($username);
    
        if ($result['code'] !== 1) {
            return response()->json([
                'success' => false,
                'message' => $result['msg'],
            ]);
        }
    
        $user = $result['data'];
    
        $response = $user->receivedGifts->map(function($userGift)
        {
            return [
                'userGiftId' => $userGift->id,
                'senderName' => $userGift->sender->name,
                'senderUserName' => $userGift->sender->username,
                'giftIcon' => $userGift->gift->icon_url,
                'msg' => $userGift->msg ?? '',
                'is_hidden' => $userGift->is_hidden,
                'receive_date' => $userGift->created_at->diffForHumans(),
                'visibility' => $userGift->visibility,
                'receiverId' => $userGift->receiver_id,
                'gift_id' => $userGift->gift_id,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $response,
        ]);
    }
    
    public function handleAction(Request $request, $userGiftId, string $action)
    { 
        $userGift = UserGift::findOrFail($userGiftId);
        switch ($action) {
            case 'show':
                $userGift->is_hidden = false;
                break;

            case 'hide':
                $userGift->is_hidden = true;
                break;

            case 'delete':
                $userGift->delete();
                return response()->json([
                    'success' => true,
                    'message' => __('gifts.deleted_successfully'),
                ]);
            
            default:
                return response()->json([
                    'success' => false,
                    'message' => __('general.invalid_action'),
                ], 400);
        }

        $userGift->save();

        return response()->json([
            'success' => true,
            'message' => __('gifts.updated_successfully'),
        ]);
    }


    
}
