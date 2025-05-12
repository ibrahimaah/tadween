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