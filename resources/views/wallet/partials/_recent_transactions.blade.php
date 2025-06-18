<ul id="transactionsList" class="list-group pe-0">
    @forelse($recent_transactions as $transaction)
        @include('wallet.partials._transaction_item', ['transaction' => $transaction])
    @empty
        <li class="list-group-item text-center py-4 text-muted" id="noTransactionsMsg">
            {{ __('wallet.no_transactions') }}
        </li>
    @endforelse
</ul>
