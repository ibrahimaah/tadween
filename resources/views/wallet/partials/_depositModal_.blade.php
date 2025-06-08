<div class="modal fade" id="depositModal" tabindex="-1" aria-labelledby="depositModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- centered modal -->
        <div class="modal-content">
            <div class="modal-header"> 
                
                <h5 class="modal-title w-100" id="depositModalLabel">{{ __('wallet.deposit_funds') }}</h5> 
                <button type="button" class="btn-close me-auto" data-bs-dismiss="modal" aria-label="{{ __('wallet.close') }}"></button>
                 
            </div>
            <form id="depositForm" action="{{ route('wallet.deposit') }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="amount" class="form-label">{{ __('wallet.amount') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="amount" name="amount" min="1" step="any" required>
                            <span class="input-group-text">{{ __('wallet.currency') }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('wallet.payment_method') }}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal" checked>
                            <label class="form-check-label" for="paypal">
                                <i class="fab fa-paypal me-2 text-primary"></i> PayPal
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="creditCard" value="credit_card">
                            <label class="form-check-label" for="creditCard">
                                <i class="fas fa-credit-card me-2 text-info"></i> {{ __('wallet.credit_debit_card') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('wallet.cancel') }}</button>
                    <button type="submit" class="btn btn-success" id="depositSubmitBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none" id="depositSpinner" role="status" aria-hidden="true"></span>
                        {{ __('wallet.deposit') }}
                    </button>
                    
                </div>
            </form>
        </div>
    </div>
</div>


@push('js')
<script>
$(document).ready(function () {
    $('#depositForm').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let url = form.attr('action');
        let data = form.serialize();

        // Show spinner and disable button
        $('#depositSpinner').removeClass('d-none');
        $('#depositSubmitBtn').attr('disabled', true);

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function (response) 
            {
               if(response.code == 1)
               {
                    // toastr.success(response.msg);
                    // $('#balance').html(response.data);
                    // $('#depositModal').modal('hide');
                    // form[0].reset();
                    // Remove "no transactions" message if present
                    // $('#noTransactionsMsg').remove();

                    // Prepend the new transaction to the list
                    // $('#transactionsList').prepend(response.transaction_html);

                     // Redirect user to google.com
                    window.location.href = response.data;
               }
               else 
               {
                    toastr.error(response.msg);
               }
            },
            error: function (xhr) 
            {
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    let message = Object.values(errors).flat().join('\n');
                    alert('Error:\n' + message);
                } else {
                    alert('Something went wrong.');
                }
            },
            complete: function () {
                // Hide spinner and enable button
                $('#depositSpinner').addClass('d-none');
                $('#depositSubmitBtn').attr('disabled', false);
            }
        });
    });
});
</script>
        
@endpush