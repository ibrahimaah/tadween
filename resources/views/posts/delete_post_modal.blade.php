<!-- Bootstrap Delete Confirmation Post Modal -->
<div class="modal fade" id="deletePostModal" tabindex="-1" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('home.confirm_delete')}}</h5>
            </div>
            <div class="modal-body">
            <p>{{__('home.post_confirm_message_delete')}}
            </p>
            <div id="deleteMessage"></div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('home.cancel')}}</button>
                <button type="button" class="btn btn-danger confirm-delete-btn" id="{{ isset($slugId) ? $slugId : ''}}">{{__('home.delete')}}</button>
            </div>
        </div>
    </div>
</div>