@include('partials.modals._delete-reply-modal')
@include('partials.modals._reply-img-modal')

<div id="errorsContainerReply" class="mb-3">
</div>


<form id="{{ $formId }}" action="{{ $action }}" method="post" class="bg-white rounded p-3 mb-5">

    @csrf

    <div class="mb-3 d-flex">
        <input type="hidden" name="slug_id" id="slug_id" value="{{ $postSlugId }}">
        <input type="hidden" name="parent_id" id="parent_id" value="{{ $parentId }}">

        <textarea id="reply_text" name="reply_text" class="form-control border-0"
            {{-- placeholder="{{ __('home.post_reply_placeholder') . ' , ' . $model->user->username }}" --}}
        >
        </textarea>
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
            <button class="btn btn-orange" id="submitBtnReply">{{ __('home.post_reply_published') }}</button>
            <div id="loadingIndicatorReply" style="display: none;">
                <div class="spinner-border text-danger" role="status">
                    <span class="visually-hidden">loading ...</span>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- HTML to display Replies On Post -->
<p class="text-center text-muted empty_replies d-none">{{__('home.post_replies_empty')}}</p>

<!-- HTML to display post -->
<div id="pullToRefreshIndicator" class="text-center d-none justify-content-center">
    <i class="fa fa-spinner fa-spin text-orange-color h1 py-3"></i>
</div>


<div class="mt-2" id="display-replies-container"></div>

<!-- Loading Spinner -->
<div class="d-none justify-content-center my-3" id="replies_loading_indicator">
    <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
