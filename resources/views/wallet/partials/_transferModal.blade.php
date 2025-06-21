 
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
 
<div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="transferModalLabel">{{ __('wallet.transfer_funds') }}</h5>
                <button type="button" class="btn-close me-auto" data-bs-dismiss="modal"
                    aria-label="{{ __('wallet.close') }}"></button>
            </div> 

            <form action="{{ route('wallet.transfer') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient" class="form-label">{{ __('wallet.recipient') }}</label>
                        <select class="form-control" name="recipient" id="recipient" required>
                            <option value="1">علي</option>
                            <option value="2">علي</option>
                            <option value="3">علي</option>
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
                    <button type="submit" class="btn btn-primary">{{ __('wallet.transfer') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $(function() {
        $('#recipient').select2();
    })
</script>
@endpush