<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class WalletController extends Controller
{
    public function __construct(private WalletService $walletService){}

    public function index()
    {
        $transactions = auth()->user()
        ->wallet
        ->transactions()
        ->latest()
        ->take(10)
        ->get();

        return view('wallet.index',['recent_transactions' => $transactions]);
    }

    public function deposit(Request $request)
    { 
        $res_deposit = $this->walletService->deposit(Auth::id(), $request->amount, ['description' => __('wallet.deposit_via_paypal')]);
        
        if($res_deposit['code'] == 0) return response()->json(['code' => 0,'msg' => $res_deposit['msg']]);

        $transaction = $res_deposit['data'];

        $transaction->capture_id = $request->captureId;;
        $transaction->save();

         // Get the latest transaction
        $transaction = auth()->user()->wallet->transactions()->latest()->first();

        $transaction_view = view('wallet.partials._transaction_item', compact('transaction'))->render();

        return response()->json([
            'code' => 1,
            'data' => $transaction,
            'msg' => $res_deposit['msg'],
            'balance' => Auth::user()->balance,
            'transaction_item_html' => $transaction_view
        ]);
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
