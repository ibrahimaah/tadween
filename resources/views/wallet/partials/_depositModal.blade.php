<div class="modal fade" id="depositModal" tabindex="-1" aria-labelledby="depositModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="depositModalLabel">{{ __('wallet.deposit_funds') }}</h5>
                <button type="button" class="btn-close me-auto" data-bs-dismiss="modal"
                    aria-label="{{ __('wallet.close') }}"></button>
            </div>

            <form id="depositForm" action="{{ route('wallet.deposit') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="amount" class="form-label">{{ __('wallet.amount') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="amount" name="amount" min="1" step="any"
                                required>
                            <span class="input-group-text">{{ __('wallet.currency_dollar') }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('wallet.cancel')
                        }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script
    src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&currency={{ env('PAYPAL_CURRENCY') }}"
    data-sdk-integration-source="button-factory">
</script>



<script>
    paypal.Buttons(
        {
            style: {
                layout: 'vertical',
                color:  'silver',
                shape:  'rect',
                label:  'paypal'
            }, 
            createOrder: function(data, actions) 
            {
                const amountInput = document.getElementById('amount');
                const amount = amountInput.value.trim();

                if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
                    alert('الرجاء إدخال مبلغ صالح قبل المتابعة.');
                    return; // Prevent the button from proceeding
                }
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            currency_code: 'USD',
                            value: amount || '0.00'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) 
            {
                return actions.order.capture().then(function(details) {
                    // Optional: Show a spinner or success message
                    alert('تم الدفع بنجاح بواسطة PayPal');
                    document.getElementById('depositForm').submit();
                });
            },
            onError: function(err) 
            {
                alert('حدث خطأ أثناء الدفع. حاول مرة أخرى.');
                console.error(err);
            }
        }
    ).render('#paypal-button-container');
</script>
@endpush