<div class="modal fade" id="{{ $id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
            </div>
            <div class="modal-body">
                <p>{{ $message }}</p> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('home.cancel') }}</button>
                <button type="button" class="btn btn-danger confirm-delete-btn" id="{{ $confirmButtonId }}">{{ __('home.yes') }}</button>
            </div>
        </div>
    </div>
</div>
