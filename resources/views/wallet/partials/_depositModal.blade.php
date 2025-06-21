@push('styles')
    <link rel="stylesheet" href="{{ asset('css/wallet/deposit_modal_styles.css') }}">
@endpush

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

                    <div id="paypal-loading" class="text-center mb-3" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">{{ __('wallet.loading') }}</span>
                        </div>
                        <p class="mt-2">{{ __('wallet.loading') }}</p>
                    </div>

                    <div class="container d-none" id="btnsPaymentChoices">
                        <div class="row justify-content-center">

                            <div class="card payment-card">
                                <div class="card-body p-4" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                                    <h4 class="card-title text-center mb-4">{{ __('wallet.choose_payment_method') }}</h4>
                                
                                    <!-- PayPal Button -->
                                    <button class="btn btn-primary px-2 w-100 paypal-btn mb-3 rounded-pill d-flex justify-content-between align-items-center" id="btnPayWithPaypal">
                                        <span class="fw-bold">{{ __('wallet.pay_with_paypal') }}</span>
                                        <i class="fab fa-cc-paypal payment-icon paypal-icon"></i>
                                    </button>
                                
                                    <!-- Separator -->
                                    <div class="payment-separator text-center my-3">
                                        <span>{{ __('wallet.or') }}</span>
                                        <span>{{ __('wallet.pay_with_card') }}</span>
                                    </div>
                                
                                    <!-- Multi-Payment Option Button -->
                                    <button class="btn w-100 multi-payment-btn rounded-pill d-flex justify-content-between align-items-center" id="btnPayWithCard">
                                        <span class="text-muted {{ app()->getLocale() == 'ar' ? 'me-2' : 'ms-2' }}">
                                            {{ app()->getLocale() == 'ar' ? 'بطاقة ائتمان / بطاقة خصم' : 'Credit/Debit Card' }}
                                        </span>
                                        <div>
                                            <i class="fab fa-cc-visa payment-icon visa-icon"></i>
                                            <i class="fab fa-cc-mastercard payment-icon mastercard-icon"></i>
                                            <i class="fab fa-cc-paypal payment-icon" style="color: #253B80;"></i>
                                        </div>
                                    </button>
                                
                                    <!-- Card Form (Initially Hidden) -->
                                    <div class="mt-4 d-none" id="cardForm">
                                        <!-- Card form would go here -->
                                    </div>
                                </div>
                                
                            </div>
                            
                            <!-- Security Info -->
                            <div class="text-center mt-3" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                                <small class="text-muted">
                                    <i class="fas fa-lock {{ app()->getLocale() == 'ar' ? 'ms-1' : 'me-1' }}"></i>
                                    {{ __('wallet.secure_payment_notice') }}
                                </small>
                            </div>
                            
                        </div>
                    </div>


                    
                    <div id="paypal-button-container" class="d-none"></div>
                    <div id="card-button-container" class="d-none"></div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('wallet.cancel')
                        }}</button>
                    <button type="button" id="continueToPayPal" class="btn btn-orange" disabled>{{ __('wallet.continue')
                        }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')

<script
    src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&components=buttons,funding-eligibility&currency={{ env('PAYPAL_CURRENCY') }}"></script>
   
<script>
    // Toastr global options
    toastr.options = {
        positionClass: "toast-top-center",
        closeButton: true,
        progressBar: true
    };
</script>



<script>
    $(function() {
        
        const $amountInput = $('#amount');
        const $continueBtn = $('#continueToPayPal');
        const $paypalWrapper = $('#paypal-wrapper');
        const $paypalLoading = $('#paypal-loading');
        const $paypalButtonContainer = $('#paypal-button-container');
        const $depositModal = $('#depositModal');
        const $depositForm = $('#depositForm');
        const btnsPaymentChoices = $('#btnsPaymentChoices');
        const btnPayWithPaypal = $('#btnPayWithPaypal');
        const btnPayWithCard = $('#btnPayWithCard');
        var paymentMethod = 'UnKnown';
        let paypalButtonsRendered = false;
        let paypalButtonRendered = false;
        let choicesButtonsRendered = false;
       
        const paypalConfig = {

            style: {
                layout: 'vertical',
                color: 'silver',
                shape: 'rect',
                label: 'paypal'
            },
            
            fundingSource: paypal.FUNDING.PAYPAL, 

            onClick: function(data, actions) 
            {    
                paymentMethod = @json(\App\Enums\PaymentMethods::PAYPAL->value); 
            },
            createOrder: function(data, actions) {
                const amount = $amountInput.val().trim() || '0.00';
                return createOrderFun(amount,actions);
            },
            onApprove: function(data, actions) {
                return onApproveFun(actions);
            },
            // Optional: Handle cancellation
            onCancel: function(data) {
                toastr.error("{{ __('wallet.payment_was_cancelled') }}");  
            },
            onError: function(err) {
                toastr.error("{{ __('wallet.error_occurred') }}");
                console.error(err);
            }
        };
        const paypalCardConfig = {
            style: {
                layout: 'vertical',
                color: 'black',
                shape: 'rect',
                label: 'paypal'
            },
            fundingSource: paypal.FUNDING.CARD, 
            onClick: function(data, actions) 
            {    
                paymentMethod = @json(\App\Enums\PaymentMethods::CREDIT_OR_DEBIT_CARD->value); 
            },
            createOrder: function(data, actions) {
                const amount = $amountInput.val().trim() || '0.00';
                return createOrderFun(amount,actions);
            },
            onApprove: function(data, actions) {
                return onApproveFun(actions);
            }, 
            onError: function(err) {
                toastr.error("{{ __('wallet.error_occurred') }}");
                console.error(err);
            }
        };

        // Enable/disable continue button based on input
        $amountInput.on('input', function() {
            const amount = parseFloat($amountInput.val());
            $continueBtn.prop('disabled', !(amount > 0));
        });

        // Continue button click handler
        $continueBtn.on('click', function() {
            const amount = parseFloat($amountInput.val());
            if (!(amount > 0)) {
                toastr.error("{{ __('wallet.please_enter_valid_amount') }}");
                return;
            }

            $continueBtn.hide();
            $paypalLoading.show();

            setTimeout(() => {
                $paypalWrapper.show();
                $paypalLoading.hide();

                btnsPaymentChoices.toggleClass('d-none')
                
                // if (!paypalButtonsRendered) {
                    // paypal.Buttons(paypalConfig).render('#paypal-button-container');
                    // paypalButtonsRendered = true;
                // }
            }, 500);
        });

        const PAYPAL = @json(\App\Enums\PaymentMethods::PAYPAL->value);
        const CARD = @json(\App\Enums\PaymentMethods::CARD->value);

        function renderButtons(method) {
            if (method === PAYPAL) {
                paypal.Buttons(paypalConfig).render('#paypal-button-container');
            } else if (method === CARD) {
                paypal.Buttons(paypalCardConfig).render('#card-button-container');
            }
        }

        function handleClick(e, method, container) {
            e.preventDefault();
            btnsPaymentChoices.toggleClass('d-none');
            $paypalLoading.show();

            setTimeout(() => {
                $paypalLoading.hide();
                renderButtons(method);
                $(container).toggleClass('d-none');
            }, 500);
        }

        btnPayWithPaypal.on('click', e => handleClick(e, PAYPAL, '#paypal-button-container'));
        btnPayWithCard.on('click', e => handleClick(e, CARD, '#card-button-container'));


        // Reset modal to initial state
        function resetModal() {
            $depositForm[0].reset();
            $paypalWrapper.hide();
            $paypalLoading.hide();
            $continueBtn.show().prop('disabled', true);
            $paypalButtonContainer.empty();
            paypalButtonsRendered = false;
            choicesButtonsRendered = false;
            btnsPaymentChoices.removeClass('d-block').addClass('d-none');
        }
        // Reset modal when hidden
        $depositModal.on('hidden.bs.modal', resetModal);
    });
</script>

<script>
    window.translations = {
        validation_failed: "{{ __('wallet.validation_failed') }}", 
        err_occur: "{{ __('wallet.error_occurred') }}", 
        wallet_updated_success: "{{ __('wallet.updated_success') }}",
    };
    window.constants = {
        url: "{{ route('wallet.deposit') }}", 
    };
</script>

@endpush