 
<div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title w-100" id="historyModalLabel">{{ __('wallet.transaction_history') }}</h5>
                <button type="button" class="btn-close me-auto" data-bs-dismiss="modal"
                    aria-label="{{ __('wallet.close') }}"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('wallet.date') }}</th>
                                <th>{{ __('wallet.description') }}</th>
                                <th>{{ __('wallet.amount') }}</th>
                                <th>{{ __('wallet.status') }}</th>
                            </tr>
                        </thead>
                        <tbody id="history-body"> 
                        </tbody>
                       
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('wallet.close') }}</button>
            </div>
        </div>
    </div>
</div>

 