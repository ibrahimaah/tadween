 
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
 <style>
    .autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-top: none;
  z-index: 99;
  max-height: 150px;
  overflow-y: auto;
  background-color: white;
  width: 100%;
}

.autocomplete-item {
  padding: 8px 12px;
  cursor: pointer;
}

.autocomplete-item:hover {
  background-color: #e9e9e9;
}

 </style>
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
                        <input type="text" class="form-control" id="recipientInput" name="recipient" placeholder="@username" autocomplete="off" required />
                        <div id="autocomplete-list" class="autocomplete-items" style="position: relative;"></div>

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
const users = @json($users->map(fn($u) => ['id' => $u->id, 'username' => $u->username]));
$(function() {
    const $input = $('#recipientInput');
    const $list = $('#autocomplete-list');
    let selectedUserId = null;

    function closeList() {
        $list.empty().hide();
    }

    $input.on('input', function() {
        const val = $(this).val();
        const atPos = val.lastIndexOf('@');

        if (atPos === -1) {
            closeList();
            return;
        }

        const query = val.slice(atPos + 1).toLowerCase();

        if (query.length === 0) {
            closeList();
            return;
        }

        const matches = users.filter(u => u.username.toLowerCase().startsWith(query));

        if (matches.length === 0) {
            closeList();
            return;
        }

        $list.empty();

        matches.forEach(u => {
            const item = $('<div class="autocomplete-item"></div>').text(u.username);
            item.on('click', function() {
                // Replace @ + typed text with the selected username
                const beforeAt = val.slice(0, atPos + 1);
                $input.val(beforeAt + u.username + ' ');
                selectedUserId = u.id;
                closeList();
            });
            $list.append(item);
        });

        $list.show();
    });

    // Close autocomplete when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#recipientInput').length && !$(e.target).closest('#autocomplete-list').length) {
            closeList();
        }
    });

    // Optional: On form submit, replace the input value with the selected user id for backend
    $('#form_transfer').on('submit', function(e) {
        e.preventDefault();

        if (!selectedUserId) {
            toastr.error('Please select a valid recipient by typing @ and choosing from the list.');
            return;
        }

        let amount = $('#transferAmount').val();
        let url = $(this).attr('action');
        let token = $('input[name="_token"]').val();

        $('#btn_transfer').attr('disabled', true).text('{{ __("wallet.transferring") }}...');

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                _token: token,
                sender_id: @json($sender_id),
                receiver_id: selectedUserId,
                amount: amount
            },
            success: function(response) {
                if(response.code)
                {
                    $('#balance').html(response.balance);
                    $('#btn_transfer').attr('disabled', false).text('{{ __("wallet.transfer") }}');
                    $('#transferModal').modal('hide');
                    $('#transactionsList').prepend(response.transaction_item_html);
                    toastr.success(response.msg);
                }
                else 
                {
                    toastr.error("{{ __('wallet.transfer_failed') }}") 
                }
            },
            error: function(xhr) {
                $('#btn_transfer').attr('disabled', false).text('{{ __("wallet.transfer") }}');
                toastr.error(xhr.responseJSON?.userMsg || "{{ __('wallet.transfer_failed') }}") 
            }
        });
    });
});

</script>
@endpush