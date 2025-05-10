<form id="replyForm" 
      action="{{ route("posts.reply.store") }}" 
      method="post" 
      class="bg-white rounded-4 p-3 mb-5">
    @csrf
    <div class="mb-3 d-flex">
        <input type="hidden" name="slug_id" id="slug_id" value="{{ $post->slug_id }}">
        <textarea id="reply_text" 
                  name="reply_text" 
                  class="form-control border-0" 
                  placeholder="{{__('home.post_reply_placeholder') .' , '. $post->user->username }}"></textarea>
    </div>

    <div class="mb-3">
        <div class="image-preview mt-2" id="imagePreviewReply"></div>
    </div>

    <div class="row">
        <div class="col">
            <div class="d-flex">
                <button type="button" class="btn text-orange-color" id="uploadImageButtonReply">
                    <i class="fas fa-image"></i>
                </button>
                <button type="button" class="btn text-orange-color" id="emojiButtonReply">
                    <i class="fas fa-smile"></i>
                </button>
            </div>
        </div>
        <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }} text-muted">
            <small>400 / <span id="countReply"> 0 </span></small>
        </div>
    </div>
    
    <input type="file" id="imageInputReply" accept="image/*" multiple style="display: none;">
    
    <div class="emoji-picker" id="emojiPickerReply" style="display: none;">
        <span>😀</span><span>😁</span><span>😂</span><span>🤣</span><span>😊</span><span>😍</span>
        <span>😎</span><span>😢</span><span>😡</span><span>👍</span><span>🙏</span><span>❤️</span>
    </div>

    <div class="row mt-2">
        <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
            <!-- زر النشر -->
            <button class="btn btn-orange" id="submitBtnReply">{{__('home.post_reply_published')}}</button>
            
            <!-- إشارة التحميل باستخدام Bootstrap (تكون مخفية افتراضيًا) -->
            <div id="loadingIndicatorReply">
                <div class="spinner-border text-danger" role="status">
                    <span class="visually-hidden">loading ...</span>
                </div>
            </div>
        </div>
    </div>
</form>