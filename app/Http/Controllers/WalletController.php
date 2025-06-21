<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositToWalletRequest;
use App\Http\Requests\TransferWallerRequest;
use App\Services\UserService;
use App\Services\WalletService;
use Exception; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class WalletController extends Controller
{
    public function __construct(private WalletService $walletService,private UserService $userService) {}

    public function index()
    {
        $wallet = Auth::user()->wallet;
        $res_users = $this->userService->getTransferWalletUsers();
        $sender_id = Auth::id();
        if($res_users['code'] == 0) dd($res_users['msg']);
        return view('wallet.index', [
            'recent_transactions' => $wallet->transactions()->latest()->take(10)->get(),
            'allTransactions'     => $wallet->transactions()->latest()->get(),
            'users'               => $res_users['data'],
            'sender_id'           => $sender_id
        ]);
    }
    

    public function deposit(DepositToWalletRequest $request)
    {
        try 
        {
            $validated = $request->validated();
            // Check PayPal status before proceeding
            $status = strtoupper($validated['status'] ?? ''); // Accepts 'COMPLETED', 'VOIDED', etc.

            if ($status !== 'COMPLETED') {
                return response()->json([
                    'code' => 0,
                    'msg' => __('wallet.payment_not_completed')  
                ]);
            }

            DB::beginTransaction(); 

            $res_deposit = $this->walletService->deposit(Auth::id(), $validated['amount']);

            if ($res_deposit['code'] == 0) {
                DB::rollBack();
                return response()->json(['code' => 0, 'msg' => $res_deposit['msg']]);
            }

            /** @var \App\Models\Transaction $transaction */
            $transaction = $res_deposit['data'];
            $transaction->capture_id = $validated['captureId'];
            $transaction->payment_method = $validated['paymentMethod'];
            $transaction->status = $status; // Save PayPal status to DB
            $transaction->save();

            DB::commit();

            // Get the latest transaction
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $transaction = $user->wallet->transactions()->latest()->first();
            $transaction_view = view('wallet.partials._transaction_item', compact('transaction'))->render();

            return response()->json([
                'code' => 1,
                'data' => $transaction,
                'msg' => $res_deposit['msg'],
                'balance' => $user->balance,
                'transaction_item_html' => $transaction_view
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['code' => 0, 'msg' => $ex->getMessage()]);
        }
    }


    public function transfer(TransferWallerRequest $request)
    {
        $validated = $request->validated();

        $sender_id = $validated['sender_id'];
        $receiver_id = $validated['receiver_id'];
        $amount = $validated['amount'];

        $res_transfer = $this->walletService->transfer($sender_id,$receiver_id,$amount);

        if($res_transfer['code'] == 0)
        {
            return response()->json([
                'code' => false,
                'msg' => $res_transfer['msg'],
                'userMsg' => __('wallet.transfer_failed')
            ],500);
        }

        // Get the latest transaction
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $transaction = $user->wallet->transactions()->latest()->first();
        $transaction_view = view('wallet.partials._transaction_item', compact('transaction'))->render();
        
        return response()->json([
            'code' => true,
            'msg' => __('wallet.transfer_success'),
            'transfer' => $res_transfer['data'],
            'balance' => Auth::user()->balance,
            'transaction_item_html' => $transaction_view
        ], 200);
    }
    // public function deposit(Request $request)
    // {
    //     $provider = new PayPalClient;
    //     $provider->setApiCredentials(config('paypal'));
    //     $token = $provider->getAccessToken();
    //     $provider->setAccessToken($token);
    //     $response = $provider->createOrder([
    //         "intent" => "CAPTURE",
    //         "purchase_units" => [
    //             [
    //                 "amount" => [
    //                     "currency_code" => "USD",
    //                     "value" => $request->amount
    //                 ]
    //             ]
    //         ],
    //         "application_context" => [
    //             "cancel_url" => route('wallet.paypal.cancel'),
    //             "return_url" => route('wallet.paypal.success')
    //         ]
    //     ]);

    //     if (isset($response['id']) && $response['status'] == 'CREATED') {
    //         foreach ($response['links'] as $link) {
    //             if ($link['rel'] === 'approve') 
    //             {
    //                 // return redirect()->away($link['href']);
    //                 return ['code' => 1 , 'data' => $link['href']];
    //             }
    //         }
    //     }

    //     return redirect()->route('paypal.cancel');
    // }

    // public function paypalSuccess(Request $request)
    // {
    //     dd($request->all());
    //     $provider = new PayPalClient;
    //     $provider->setApiCredentials(config('paypal'));
    //     $provider->setAccessToken($provider->getAccessToken());
    //     $response = $provider->capturePaymentOrder($request->token);

    //     if ($response['status'] == 'COMPLETED') {
    //         dd('success');
    //         // Store order/payment info in DB
    //         // return view('payment-success');
    //     }

    //     return redirect()->route('wallet.paypal.cancel');
    // }

    // public function paypalCancel()
    // {
    //     dd('cancelled');
    // }


    // public function deposit(Request $request)
    // { 
    //     $res_deposit = $this->walletService->deposit($request->user_id, $request->amount, ['description' => __('wallet.deposit_via_paypal')]);

    //     if($res_deposit['code'] == 0) return response()->json(['code' => 0,'msg' => $res_deposit['msg']]);

    //      // Get the latest transaction
    //         $transaction = auth()->user()
    //         ->wallet
    //         ->transactions()
    //         ->latest()
    //         ->first();

    //     $transaction_view = view('wallet.partials._transaction_item', compact('transaction'))->render();

    //     return response()->json([
    //         'code' => 1,
    //         'data' => $res_deposit['data'],
    //         'msg' => $res_deposit['msg'],
    //         'transaction_html' => $transaction_view
    //     ]);
    // }
}
