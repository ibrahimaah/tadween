<div class="text-dark row">
    <div class="col-1 d-flex justify-content-center"> 
    </div>
    <div class="col-11">
        @if($reply->reply_text)
            <p class="post-text mb-3">{{ $reply->reply_text }}</p>
        @endif
        @if($reply->reply_image)
        <div class="row"> 
            <div class="col-1"></div>
            <div class="col-10">
                <img src="{{ asset($reply->reply_image) }}" class="img-fluid" alt="post Image">
            </div>
            <div class="col-1"></div>
        </div>
        @endif
    </div>
</div> 
