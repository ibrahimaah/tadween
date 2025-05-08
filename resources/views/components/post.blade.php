@php
    $dropMenuClass = app()->getLocale() === 'ar' ? 'text-end' : 'text-start';

    // $options = $post['poll']['options'];
    // $totalVotes = collect($options)->sum('votes');
@endphp

<div class="bg-white rounded-top rounded-right rounded-left p-3" id="post{{ $post->slug_id }}">
   <!-- Begin Post Header -->
    <div class="d-flex justify-content-between">
        <a href="{{ route('profile',$post->user->username) }}" 
           class="d-flex text-decoration-none text-dark">

            <img src="{{ $post->user_profile_img }}" 
                 class="rounded-circle logo-main" 
                 alt="User Image">

            <div class="px-1">
                <p class="mx-1 mb-0">{{ $post->user->name }} {{ $post->user->is_private() ? '<i class="fa-solid fa-lock text-orange-color me-1"></i>' : '' }}
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
    <!-- End Post Header -->

    <!-- Begin Post Body -->
    @if($post->post_type == 'normal')
        <div class="text-dark row">
            <div class="col-1 d-flex justify-content-center"> 
            </div>
            <div class="col-11">
                <p class="post-text mb-3">{{ $post->text }}</p>
                <div class="row"> 
                    <img src="{{ $post->first_image }}" class="img-fluid" alt="post Image">
                </div>
            </div>
        </div>
    @else    

        @php
            $poll = $post->getPollData();
            $options = $poll['options'];
            $totalVotes = collect($options)->sum('votes');
        @endphp

        <div class="text-dark row"> 
            <div class="col-11">
                <h4 class="mb-4">{{ $post->text }}</h4>

                @foreach ($options as $option)
                    @php
                        $percent = $totalVotes === 0 ? 0 : ($option['votes'] / $totalVotes) * 100;
                    @endphp

                    @if (!empty($option['option_text']))
                        <div class="mb-3">
                            <button class="btn btn-outline-danger w-100 vote-btn"
                                data-option="{{ $option['option_text'] }}"
                                data-post="{{ $post->slug_id }}">
                                {{ $option['option_text'] }}
                            </button>
                            <div class="progress mt-2">
                                <div class="progress-bar bg-danger" style="width: {{ $percent }}%;">
                                    {{ round($percent) }}%
                                </div>
                            </div>
                            <span class="vote-count">{{ $option['votes'] }} {{ __('vote') }}</span>
                        </div>
                    @endif
                @endforeach

                <p class="mt-3 text-muted">📊 {{ __('totalVotes') }} <strong>{{ $totalVotes }}</strong></p>
                <p class="mt-4 text-muted">⏳ {{ __('voteEnds') }} {{ $poll['expires_at'] }}</p>
            </div>
        </div>
    @endif
    <!-- End Post Body -->


     <!-- Begin Post Footer -->

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
    <!-- End Post Footer -->
</div>