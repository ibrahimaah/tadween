 <!-- Bootstrap Delete Confirmation Modal -->
 <div class="modal fade" id="deleteReplyModal" tabindex="-1" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('home.confirm_delete')}}</h5>
            </div>
            <div class="modal-body">
            <p>{{__('home.reply_confirm_message_delete')}}
            </p>
            <div id="deleteMessageReply"></div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('home.cancel')}}</button>
                <button type="button" class="btn btn-danger confirm-delete-btn-reply" id="">{{__('home.delete')}}</button>
            </div>
        </div>
    </div>
</div>