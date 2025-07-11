<?php

namespace App\Services;

use App\Constants\WithdrawType;
use App\Models\Gift;
use App\Models\UserGift;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class GiftService
{
    /**
     * Send a gift from sender to receiver.
     *
     * @param int $senderId
     * @param int $receiverId
     * @param int $giftId
     * @param string $visibility ('public', 'private', 'anonymous')
     * @return array ['code' => int, 'data' => mixed, 'msg' => string|null]
     */
    public function sendGift(int $senderId, int $receiverId, int $giftId, string $visibility = 'public'): array
    {
        try {
            $sender = User::findOrFail($senderId);
            $receiver = User::findOrFail($receiverId);
            $gift = Gift::findOrFail($giftId);

            $alreadySent = UserGift::where('sender_id', $senderId)
                                    ->where('receiver_id', $receiverId)
                                    ->where('gift_id', $giftId)
                                    ->exists();
            if($alreadySent)
            {
                return ['code' => 0, 'msg' => __('gifts.already_sent')];
            }


            // info($gift->price);
            if ($sender->balance < $gift->price) {
                return ['code' => 0, 'msg' => __('gifts.insufficient_balance')];
            }
            
            if ($senderId === $receiverId) {
                return ['code' => 0, 'msg' => __('gifts.cannot_send_self')];
            }
            

            DB::transaction(function () use ($sender, $receiver, $gift, $visibility) {

                $meta = [
                    'reason_en' => __('wallet.send_gift', [], 'en') . ' ' .__('wallet.transfer_to', [], 'en') . ' ' .
                        "<a class='text-orange text-reset text-decoration-none' href='" . route('profile', $receiver->username) . "'>" . $receiver->name . "</a>",
                
                    'reason_ar' => __('wallet.send_gift', [], 'ar') . ' ' .__('wallet.transfer_to', [], 'ar') . ' ' .
                        "<a class='text-orange text-reset text-decoration-none' href='" . route('profile', $receiver->username) . "'>" . $receiver->name . "</a>",
                ];
                $transaction = $sender->withdraw($gift->price, $meta);
                $transaction->withdraw_type = WithdrawType::SEND_GIFT;
                $transaction->save();

                // $sender->decrement('wallet_balance', $gift->price);

                UserGift::create([
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiver->id,
                    'gift_id' => $gift->id,
                    'visibility' => $visibility,
                ]);
            });

            return ['code' => 1, 'data' => true];
        } catch (Throwable $th) {
            return ['code' => 0, 'msg' => $th->getMessage()];
        }
    }

  

    /**
     * Get gifts received by a user.
     *
     * @param int $userId
     * @param int|null $viewerId The id of user viewing (to filter private gifts)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getReceivedGifts(int $userId, ?int $viewerId = null)
    {
        $query = UserGift::with(['gift', 'sender'])
            ->where('receiver_id', $userId);

        // If viewer is not the receiver, hide private gifts
        if ($viewerId !== $userId) {
            $query->where('visibility', '!=', 'private');
        }

        return $query->get();
    }

    public function getGifts()
    {
        try 
        {
            $gifts = Gift::with('media')->get();
            return ['code' => 1, 'data' => $gifts];
        }
        catch(Throwable $th)
        {
            return ['code' => 0, 'msg' => $th->getMessage()];
        }
    }

    public function getGiftById($id)
    {
        try 
        {
            $gift = Gift::findOrFail($id);
            return ['code' => 1, 'data' => $gift];
        }
        catch(Throwable $th)
        {
            return ['code' => 0, 'msg' => $th->getMessage()];
        }
    }
}
