<div class="modal fade" id="{{ $id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
            </div>
            <div class="modal-body">
                <p id="modal_msg">{{ $message }}</p> 
                <input type="hidden" id="user_gift_id" name="gift_id">
                <input type="hidden" id="gift_action" name="gift_action">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('home.cancel') }}</button>
                <button type="button" class="btn btn-orange confirm-delete-btn confirm_btn" id="{{ $confirmButtonId }}">{{ __('home.yes') }}</button>
            </div>
        </div>
    </div>
</div>
