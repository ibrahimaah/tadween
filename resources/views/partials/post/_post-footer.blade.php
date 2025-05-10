<div class="row text-center">
    <div class="col-1 d-flex justify-content-center"> 
    </div>
    <div class="col-11 mt-3">
        <div class="row">
            <div class="col">
                <a href="{{ route('posts.show',$post->slug_id) }}" 
                   class="text-decoration-none text-dark link_hover">
                   {{ $post->comments_count ?? 0 }} <i class="fa-regular fa-message"></i>
                </a>
            </div>
            <div class="col">0 <i class="fa-solid fa-rotate"></i></div>
            <div class="col" id="post-like-section" post-slug-data="{{ $post->slug_id }}">
                <span class="link_hover">
                    <span id="post-like-count">{{ $post->post_likes_count ?? 0 }}</span>
                    <i class="fa-regular fa-thumbs-up {{ $post->is_post_liked() ? 'text-orange-color' : '' }}" id="post-like-btn"></i>
                </span>
            </div>
            <div class="col"><i class="fa-regular fa-share-from-square"></i></div>
        </div>
    </div>
</div>