<li class="list-group-item">
    <div class="d-flex justify-content-between align-items-center {{ app()->getLocale() == 'ar' ? 'flex-row-reverse' : '' }} mb-2">
        <span class="badge {{ $transaction->amount > 0 ? 'bg-success' : 'bg-danger' }} rounded-pill">
            {{ $transaction->amount > 0 ? '+' : '' }}{{ $transaction->amount }} {{ __('wallet.currency_dollar') }}
        </span>
        <div>
            <h6 class="mb-1 {{ app()->getLocale() == 'ar' ? 'text-end' : '' }}">
                {{ $transaction->meta['description'] ?? __('wallet.transaction') }}
            </h6>
            <small class="text-muted {{ app()->getLocale() == 'ar' ? 'text-end d-block' : '' }}">
                {{ $transaction->created_at->diffForHumans() }}
            </small>
        </div>
    </div>
</li>
