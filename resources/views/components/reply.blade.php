<div class="bg-white rounded-4 p-3 my-2" id="reply{{ $reply->slug_id }}">
    <div class="d-flex justify-content-between">
        <a href="/{{ $reply->user->username }}" class="d-flex text-decoration-none text-dark">
            <img src="{{ $reply->user->cover_image ?? asset('img/user.jpg') }}" class="rounded-circle logo-main" alt="User Image">
            <div class="px-1">
                <p class="mx-1 mb-0">
                    {{ $reply->user->name }}
                    @if ($reply->user->is_private())
                        <i class="fa-solid fa-lock text-orange-color me-1"></i>
                    @endif
                </p>
                <p class="mx-1 mt-0 text-grey">{{ $reply->user->username }} ({{ $reply->created_at }})</p>
            </div>
        </a>

        @if(auth()->id() == $reply->user_id)
        <div class="dropstart">
            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical text-orange-color"></i>
            </button>

            <ul class="dropdown-menu ${dropMenuClass}">
                <li>
                    <!-- Delete Reply Link -->
                    <button class="dropdown-item delete-reply-btn" id="" data-bs-toggle="modal" data-bs-target="#deleteReplyModal">
                        <i class="fa-regular fa-trash-can text-orange-color"></i><span class="mx-1"></span>
                    </button>
                </li>
            </ul>
        </div>
        @endif  
    </div>

    <p class="post-text mb-3">{{ $reply->reply_text ?? '' }}</p>
    <p class="w-25">{!! $reply->reply_image !!}</p>

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
</div>
