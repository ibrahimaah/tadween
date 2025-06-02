<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\WalletService;
use Illuminate\Http\Request;

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
        $res_deposit = $this->walletService->deposit($request->user_id, $request->amount, ['description' => __('wallet.deposit_via_paypal')]);
        
        if($res_deposit['code'] == 0) return response()->json(['code' => 0,'msg' => $res_deposit['msg']]);

         // Get the latest transaction
            $transaction = auth()->user()
            ->wallet
            ->transactions()
            ->latest()
            ->first();

        $transaction_view = view('wallet.partials._transaction_item', compact('transaction'))->render();

        return response()->json([
            'code' => 1,
            'data' => $res_deposit['data'],
            'msg' => $res_deposit['msg'],
            'transaction_html' => $transaction_view
        ]);
    }
}
