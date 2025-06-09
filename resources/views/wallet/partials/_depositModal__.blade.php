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

                    <div class="text-center mb-3" id="paypal-loading" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">{{ __('wallet.loading') }}</span>
                        </div>
                        <p class="mt-2">{{ __('wallet.loading') }}</p>
                    </div>

                    
                    <div class="mb-3" id="paypal-wrapper" style="display: none;">
                        <div id="paypal-button-container"></div>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('wallet.cancel') }}</button>
                    <button type="button" id="continueToPayPal" class="btn btn-orange" disabled>{{ __('wallet.continue') }}</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

@push('js')
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&currency={{ env('PAYPAL_CURRENCY') }}" data-sdk-integration-source="button-factory"></script>
<script>
    toastr.options = {
        "positionClass": "toast-top-center",
        "closeButton": true,
        "progressBar": true
    };
</script>

<script>
    let paypalButtonsRendered = false;

    const amountInput = $('#amount');
    const continueButton = $('#continueToPayPal');
    const paypalWrapper = $('#paypal-wrapper');
    const paypalLoading = $('#paypal-loading');
    const paypalButtonContainer = $('#paypal-button-container');
    const depositModal = $('#depositModal');
    const depositForm = $('#depositForm');

    const reset = () => {
        depositForm[0].reset();
        paypalWrapper.hide();
        paypalLoading.hide();
        continueButton.show();
        paypalButtonContainer.empty();
        paypalButtonsRendered = false;
        continueButton.prop('disabled', true);
    }

    const paypalConfig = {
        style: {
            layout: 'vertical',
            color: 'silver',
            shape: 'rect',
            label: 'paypal'
        },
        createOrder: function (data, actions) {
            const amount = amountInput.val().trim();
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        currency_code: '{{ env("PAYPAL_CURRENCY", "USD") }}',
                        value: amount || '0.00'
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(details => {
                    const {
                        payer: {
                            name: { given_name, surname }
                        },
                        purchase_units
                    } = details;

                    const payment = purchase_units[0].payments.captures[0];
                    const payerName = `${given_name} ${surname}`;
                    const { id: captureId, amount: { value: amount, currency_code: currency } } = payment;

                    // alert(`Payment successful! Thank you, ${payerName}. Amount: ${amount} ${currency}`);
                    console.log('Full details:', details);

                    $.ajax({
                        url: "{{ route('wallet.deposit') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            amount,
                            captureId
                        },
                        success: response => {
                            
                            $('#balance').html(response.balance);
                            $('#depositModal').modal('hide');
                            $('#noTransactionsMsg').remove(); 
                            $('#transactionsList').prepend(response.transaction_html);
                            reset();
                            toastr.success("{{ __('wallet_updated_success') }}"); 
                        },
                        error: xhr => {
                            toastr.error("{{ __('wallet.error_occurred') }}");
                            console.error(xhr);
                        }
                    });
                });
        },
        onError: function (err) {
            toastr.error("{{ __('wallet.error_occurred') }}");
            console.error(err);
        }
    };

    continueButton.on('click', function () {
        const amount = parseFloat(amountInput.val());
        if (!amount || amount <= 0) {
            toastr.error("{{ __('wallet.please_enter_valid_amount') }}");
            return;
        }

        continueButton.hide();
        paypalLoading.show();

        setTimeout(() => {
            paypalWrapper.show();
            paypalLoading.hide();

            if (!paypalButtonsRendered) {
                paypal.Buttons(paypalConfig).render('#paypal-button-container');
                paypalButtonsRendered = true;
            }
        }, 500);
    });

    depositModal.on('hidden.bs.modal', reset);


  
</script>

<script>
    amountInput.on('input', function () {
        const amount = parseFloat(amountInput.val());
        if (amount > 0) {
            continueButton.prop('disabled', false);
        } else {
            continueButton.prop('disabled', true);
        }
    });
</script>

@endpush

