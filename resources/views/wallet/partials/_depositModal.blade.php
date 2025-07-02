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
                    
                    <div class="mb-3" id="amountDiv">
                        <label for="amount" class="form-label">{{ __('wallet.amount') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="amount" name="amount" min="1" step="any"
                                required>
                            <span class="input-group-text">{{ __('wallet.currency_dollar') }}</span>
                        </div>
                        <small class="text-muted mt-1 d-block" style="font-size: 0.9em;">
                            {{ __('wallet.payment_gateway_fee_not_deducted') }}
                        </small>
                    </div>


                    <div class="form-check form-check-reverse alert alert-danger" id="noticeDiv">
                        <input class="form-check-input me-0 ms-1" type="checkbox" value="1" id="nonRefundableCheckbox">
                        <label class="form-check-label" for="nonRefundableCheckbox">
                            {{ __('wallet.non_refundable_notice') }}
                        </label>
                    </div>  
                    


                    <div id="paypal-loading" class="text-center mb-3" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">{{ __('wallet.loading') }}</span>
                        </div>
                        <p class="mt-2">{{ __('wallet.loading') }}</p>
                    </div>

                    <div class="container" style="display: none" id="btnsPaymentChoices">
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
                                            {{-- <i class="fab fa-cc-paypal payment-icon" style="color: #253B80;"></i> --}}
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

                    <div id="paypal-button-container" style="display: none"></div>
                    <div id="card-button-container" style="display: none"></div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('wallet.cancel') }}
                    </button>
                
                    <button type="button" class="btn btn-outline-secondary d-none me-auto" id="backToAmount">
                        <i class="fas fa-arrow-left me-2"></i> {{ __('wallet.back') }}
                    </button>
                
                    <button type="button" id="continueToPayPal" class="btn btn-orange" disabled>
                        {{ __('wallet.continue') }}
                    </button>
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
        let currentStep = 1;
        const PAYPAL = @json(\App\Enums\PaymentMethods::PAYPAL->value);
        const CARD = @json(\App\Enums\PaymentMethods::CARD->value);

        const amountInput = $('#amount');
        const continueBtn = $('#continueToPayPal'); 
        const paypalLoading = $('#paypal-loading');
        const paypalButtonContainer = $('#paypal-button-container');
        const cardButtonContainer = $('#card-button-container');
        const depositModal = $('#depositModal');
        const depositForm = $('#depositForm');
        const btnsPaymentChoices = $('#btnsPaymentChoices');
        const btnPayWithPaypal = $('#btnPayWithPaypal');
        const btnPayWithCard = $('#btnPayWithCard'); 
        const checkbox = $('#nonRefundableCheckbox');
        const amountDiv = $('#amountDiv');
        const noticeDiv = $('#noticeDiv');
        const backBtn = $('#backToAmount');

        // noticeDiv.hide();
        const createPaypalConfig = (fundingSource, style, methodValue) => ({
            style,
            fundingSource,
            onClick: function (data, actions) {
                const isChecked = checkbox.is(':checked');
                const amount = parseFloat(amountInput.val());

                if (!isChecked) {
                    toastr.error("{{ __('wallet.please_accept_non_refundable') }}");
                    return actions.reject(); // stop PayPal flow
                }
                if(!(amount > 0))
                {
                    toastr.error("{{ __('wallet.please_enter_valid_amount') }}");
                    return actions.reject();
                }

                return actions.resolve(); // allow PayPal flow
            },
            createOrder: function (data, actions) {
                const amount = amountInput.val().trim() || '0.00';
                return createOrderFun(amount, actions);
            },
            onApprove: function (data, actions) {
                return onApproveFun(actions,methodValue);
            },
            onError: function (err) {
                toastr.error("{{ __('wallet.error_occurred') }}");
                console.error(err);
            }
        });

        const paypalConfig = createPaypalConfig(
            paypal.FUNDING.PAYPAL,
            {
                layout: 'vertical',
                color: 'silver',
                shape: 'rect',
                label: 'paypal'
            },
            @json(\App\Enums\PaymentMethods::PAYPAL->value)
        );

        const paypalCardConfig = createPaypalConfig(
            paypal.FUNDING.CARD,
            {
                layout: 'vertical',
                color: 'black',
                shape: 'rect',
                label: 'paypal'
            },
            @json(\App\Enums\PaymentMethods::CREDIT_OR_DEBIT_CARD->value)
        );

        const updateContinueButtonState = () => {
            const amount = parseFloat(amountInput.val());
            const isCheckboxChecked = checkbox.is(':checked'); 
            continueBtn.prop('disabled', !(amount > 0 && isCheckboxChecked));
            if (!checkbox.is(':checked')) {
                checkbox.closest('.form-check').addClass('border border-danger');
            } else {
                checkbox.closest('.form-check').removeClass('border border-danger');
            }

        }
  
        const handleClick = (e, method, container) => {
            e.preventDefault();
            if (!checkbox.is(':checked')) {
                toastr.error("{{ __('wallet.please_accept_non_refundable') }}");
                return;
            }
            btnsPaymentChoices.hide();
            paypalLoading.show();
            setTimeout(() => {
                paypalLoading.hide();
                if (method === PAYPAL) {
                    paypal.Buttons(paypalConfig).render('#paypal-button-container');
                } else if (method === CARD) {
                    paypal.Buttons(paypalCardConfig).render('#card-button-container');
                }
                $(container).show();
                currentStep = 3;
            }, 500);
        }


        // Reset modal to initial state
        const resetModal = () => {
            depositForm[0].reset(); 
            checkbox.prop('checked', false);
            paypalLoading.hide();   
            continueBtn.show().prop('disabled', true); 
            amountDiv.show();
            $('#noticeDiv').removeClass('d-none');
            paypalButtonContainer.empty().hide();
            cardButtonContainer.empty().hide();
            backBtn.addClass('d-none');
            btnsPaymentChoices.hide();  
            currentStep = 1;
        }

        amountInput.on('input', updateContinueButtonState);
        checkbox.on('change', updateContinueButtonState);

        backBtn.on('click', function () {
            if (currentStep === 3) {
                // Go back to payment choices
                paypalButtonContainer.empty().hide();
                cardButtonContainer.empty().hide();
                btnsPaymentChoices.show();
                currentStep = 2;
            } else if (currentStep === 2) {
                // Go back to amount input
                btnsPaymentChoices.hide();
                amountDiv.show();
                $('#noticeDiv').removeClass('d-none');
                continueBtn.show().prop('disabled', false);
                backBtn.addClass('d-none');
                currentStep = 1;
            }
        });


        // Continue button click handler
        continueBtn.on('click', function() 
        {
            const amount = parseFloat(amountInput.val());
            if (!(amount > 0)) {
                toastr.error("{{ __('wallet.please_enter_valid_amount') }}");
                return;
            }
            continueBtn.hide();
            backBtn.removeClass('d-none');
            amountDiv.hide();
            $('#noticeDiv').addClass('d-none');
            paypalLoading.show();
            setTimeout(() => { 
                paypalLoading.hide();
                btnsPaymentChoices.show();
                currentStep = 2;
            }, 500);
        });

        btnPayWithPaypal.on('click', e => handleClick(e, PAYPAL, '#paypal-button-container'));
        btnPayWithCard.on('click', e => handleClick(e, CARD, '#card-button-container'));
        
        // Reset modal when hidden
        depositModal.on('hidden.bs.modal', resetModal);
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