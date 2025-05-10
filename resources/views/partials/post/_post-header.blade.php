@php
    $dropMenuClass = app()->getLocale() === 'ar' ? 'text-end' : 'text-start'; 
@endphp

<div class="d-flex justify-content-between">
    <a href="{{ route('profile',$post->user->username) }}" 
       class="d-flex text-decoration-none text-dark">

        <img src="{{ $post->user_profile_img }}" 
             class="rounded-circle logo-main" 
             alt="User Image">

        <div class="px-1">
            <p class="mx-1 mb-0">
                {{ $post->user->name }}
                @if($post->user->is_private())
                    <i class="fa-solid fa-lock text-orange-color me-1"></i>
                @endif
            </p>
            
            
            <p class="mx-1 mt-0 text-grey">
                {{ $post->user->username }} ({{ $post->created_at_diff }})
            </p>
            
        </div>
    </a>
    @if($post->is_owner())
        <div class="dropstart">
            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical text-orange-color"></i>
            </button>
            <ul class="dropdown-menu {{ $dropMenuClass }}">
                <li>
                    <button class="dropdown-item delete-post-btn" 
                            id="{{ $post->slug_id }}" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deletePostModal">
                        <i class="fa-regular fa-trash-can text-orange-color"></i>
                        <span class="mx-1">
                            {{ __('post.delete_post') }}
                        </span>
                    </button>
                </li>
            </ul>
        </div>
    @endif
</div>