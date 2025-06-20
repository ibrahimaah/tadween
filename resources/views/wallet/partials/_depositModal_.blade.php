<style>
    .payment-card {
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }

    /* .payment-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    } */

    .paypal-btn {
        background: linear-gradient(135deg, #253B80 0%, #179BD7 100%);
        border: none;
        padding: 12px 0;
    }

    .multi-payment-btn {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 1px solid #dee2e6;
        padding: 12px 0;
    }

    .payment-icon {
        font-size: 1.8rem;
        margin: 0 8px;
        vertical-align: middle;
    }

    .paypal-icon {
        color: white;
    }

    .visa-icon {
        color: #1A1F71;
    }

    .mastercard-icon {
        color: #EB001B;
    }

    .payment-separator {
        display: flex;
        align-items: center;
        margin: 20px 0;
    }

    .payment-separator::before,
    .payment-separator::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid #dee2e6;
    }

    .payment-separator span {
        padding: 0 10px;
        color: #6c757d;
        font-size: 0.9rem;
    }
</style>
</style>
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

       
        const paypalConfig = {
            style: {
                layout: 'vertical',
                color: 'silver',
                shape: 'rect',
                label: 'paypal'
            },
            fundingSource: paypal.FUNDING.PAYPAL,
              // onClick is called when the buyer clicks the PayPal button
            onClick: function(data, actions) 
            {
                // console.log('Button clicked data:', data);
                if (data.fundingSource) 
                {
                    if (data.fundingSource === 'paypal') 
                    {
                        paymentMethod = @json(\App\Enums\PaymentMethods::PAYPAL->value);
                        // Add specific logic for PayPal payments here
                    } 
                    else if (data.fundingSource === 'card') 
                    {
                        paymentMethod = @json(\App\Enums\PaymentMethods::CREDIT_OR_DEBIT_CARD->value);
                    }
                    // You can check for other funding sources like 'venmo', 'paylater', etc.
                    // based on your PayPal setup.
                } else {
                    console.log('Funding source information not available in this click context.');
                }
            },
            createOrder: function(data, actions) {
                const amount = $amountInput.val().trim() || '0.00';
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            currency_code: '{{ env("PAYPAL_CURRENCY", "USD") }}',
                            value: amount
                        }
                    }],
                    application_context: {
                        shipping_preference: 'NO_SHIPPING', // 👈 Hides billing/shipping fields 
                    }
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(details => {
                    const payerName = `${details.payer.name.given_name} ${details.payer.name.surname}`;
                    const payment = details.purchase_units[0].payments.captures[0];
                    const status = payment.status || 'UNKNOWN';
                    const { id: captureId, amount: { value, currency_code } } = payment;

                    // console.log('Payment details:', details); 

                    // const paymentSource = details.payment_source ? Object.keys(details.payment_source)[0] : 'paypal';

                    // Send payment info to server
                    $.ajax({
                        url: "{{ route('wallet.deposit') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            amount: value,
                            captureId,
                            paymentMethod,
                            status ,
                            details
                        },
                        success: response => {
                            $('#balance').html(response.balance);
                            $('#noTransactionsMsg').remove();
                            $('#transactionsList').prepend(response.transaction_item_html);
                            toastr.success("{{ __('wallet.updated_success') }}");
                            $depositModal.modal('hide');
                            resetModal();
                        },
                        error: xhr => {
                            if (xhr.status === 422) {
                                // Validation error
                                const response = xhr.responseJSON;
                                if (response && response.msg) {
                                    // If msg is an array, join it; otherwise display as-is
                                    const messages = Array.isArray(response.msg) ? response.msg.join('<br>') : response.msg;
                                    toastr.error(messages);
                                } else {
                                    toastr.error("{{ __('wallet.validation_failed') }}");
                                }
                            } else {
                                // Other errors
                                toastr.error("{{ __('wallet.error_occurred') }}");
                                console.error(xhr);
                            }
                        }

                    });
                });
            },
            // Optional: Handle cancellation
            onCancel: function(data) {
                toastr.error("{{ __('wallet.payment_was_cancelled') }}"); 
                // You can redirect or update the UI here
                // window.location.href = '/payment/cancelled'; // 👈 Customize this
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

        const renderButtons = () => paypal.Buttons(paypalConfig).render('#paypal-button-container');

        btnPayWithPaypal.on('click',function(e)
        {
            e.preventDefault();
            btnsPaymentChoices.toggleClass('d-none'); 
            $paypalLoading.show();
            setTimeout(() => { 
                $paypalLoading.hide();
                renderButtons();
                $('#paypal-button-container').toggleClass('d-none');
                // $('#card-button-container').hide();
            }, 500);
        });



        // Reset modal when hidden
        $depositModal.on('hidden.bs.modal', resetModal);
    });
</script>
@endpush