 
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
 
<div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="transferModalLabel">{{ __('wallet.transfer_funds') }}</h5>
                <button type="button" class="btn-close me-auto" data-bs-dismiss="modal"
                    aria-label="{{ __('wallet.close') }}"></button>
            </div> 

            <form action="{{ route('wallet.transfer') }}" method="POST" id="form_transfer">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient" class="form-label">{{ __('wallet.recipient') }}</label>
                        <select class="form-control" name="recipient" id="recipient" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option> 
                            @endforeach
                        </select> 
                    </div>
                    <div class="mb-3">
                        <label for="transferAmount" class="form-label">{{ __('wallet.amount') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="transferAmount" name="amount" min="1" required>
                            <span class="input-group-text">{{ __('wallet.currency_dollar') }}</span>
                        </div>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="note" class="form-label">{{ __('wallet.note') }} ({{ __('wallet.optional') }})</label>
                        <textarea class="form-control" id="note" name="note" rows="2"></textarea>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('wallet.cancel') }}</button>
                    <button type="submit" class="btn btn-primary" id="btn_transfer">{{ __('wallet.transfer') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')

<script src="{{ asset('js/select2.min.js') }}"></script>

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
    $('#transferModal').on('shown.bs.modal', function () {
        $('#recipient').select2({
            dropdownParent: $('#transferModal') // Important for Bootstrap modals
        });
    });
    let sender_id = @json($sender_id);

    $('#form_transfer').on('submit', function(e) {
        e.preventDefault();

        let receiver_id = $('#recipient').val();
        let amount = $('#transferAmount').val();
        let url = $(this).attr('action');
        let token = $('input[name="_token"]').val();

        $('#btn_transfer').attr('disabled', true).text('{{ __("wallet.transferring") }}...');

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                _token: token,
                sender_id: sender_id,
                receiver_id: receiver_id,
                amount: amount
            },
            success: function(response) {
                if(response.code)
                {
                    $('#balance').html(response.balance);
                    $('#btn_transfer').attr('disabled', false).text('{{ __("wallet.transfer") }}');
                    // Optional: close modal
                    $('#transferModal').modal('hide');
                    $('#transactionsList').prepend(response.transaction_item_html);
                    toastr.success(response.msg);
                }
                else 
                {
                    toastr.error("{{ __('wallet.transfer_failed') }}") 
                }

                // Optional: refresh wallet balance or transaction history
            },
            error: function(xhr) {
                $('#btn_transfer').attr('disabled', false).text('{{ __("wallet.transfer") }}');
                // let msg = xhr.responseJSON?.msg || '{{ __("wallet.transfer_failed") }}';
                toastr.error(xhr.responseJSON?.userMsg || "{{ __('wallet.transfer_failed') }}") 
            }
        });
    });
});
</script>
@endpush