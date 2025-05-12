<div class="bg-white rounded-top p-3 my-2" id="reply{{ $reply->slug_id }}">

    @include('partials.reply._reply-header',['reply' => $reply])

    @include('partials.reply._reply-body',['reply' => $reply])

    @include('partials.reply._reply-footer',['replyShowRoute' => $replyShowRoute,'reply' => $reply])
</div>