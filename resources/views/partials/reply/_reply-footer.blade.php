<div class="row text-center mt-3">
    <div class="col">
        <a href="{{ $replyShowRoute }}" class="text-decoration-none text-dark link_hover">
            <span class="comments_count">0</span> 
            <i class="fa-regular fa-message"></i>
        </a>
    </div>
    <div class="col">0 <i class="fa-solid fa-rotate"></i></div>
    <div class="col" id="post-like-section" post-slug-data="{{ $reply->slug_id }}">
        <span class="link_hover">
            <span id="post-like-count">0</span>
            <i class="fa-regular fa-thumbs-up" id="post-like-btn"></i>
        </span>
    </div>
    <div class="col"><i class="fa-regular fa-share-from-square"></i></div>
</div>