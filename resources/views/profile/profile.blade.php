@extends('layouts.main_app')

@section('pageTitle')
{{$data['name']}}
@endsection

@section('content')
<style>
    .dots-btn {
        background: none;
        border: none;
        font-size: 24px;
        padding: 5px;
        cursor: pointer;
        transition: opacity 0.2s ease-in-out;
    }
    .dots-btn:hover,
    .dots-btn:focus {
        opacity: 0.7;
    }
</style>




<div class="profile">

    <div id="pullToRefreshIndicator" class="text-center d-none justify-content-center">
        <i class="fa fa-spinner fa-spin text-orange-color h1 py-3"></i>
    </div>

    <x-page-header title="{{$data['name']}}" route="home" />

   <div class="container bg-white">
    <div class="row">

        <div class="col-12">
            <img class="profile_background_image"
                style="object-fit:contain"
                src="{{ $data['background_image'] }}"
                alt="Tadween logo..."
            >
        </div>

        <div class="col-12">
            @if (!$data['is_owner'])
                @if(!$data['is_been_blocked'])
                    <div id="follow{{$data['username']}}" class="col-12 follow_btn_margin text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                        
                        <div class="d-flex justify-content-end align-items-center">
                            <div class="dropdown">
                                <button class="dots-btn text-orange-color" 
                                        type="button" 
                                        id="dropdownMenuButton" 
                                        data-bs-toggle="dropdown">
                                    &#x22EF; <!-- Horizontal Ellipsis -->
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end py-0">
                                    <li>
                                        @if($data['is_blocked'])
                                            <form action="{{ route('users.unblock') }}" method="POST" class="unblock-user-form">
                                                @csrf
                                                <input type="hidden" name="username" value="{{ $data['username'] }}" required>
                                                <button type="submit" class="dropdown-item unblock-button">
                                                    <i class="fas fa-ban text-orange-color"></i> {{ __('profile.unblock_this_user') }}
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('users.block') }}" method="POST" class="block-user-form">
                                                @csrf
                                                <input type="hidden" name="username" value="{{ $data['username'] }}" required>
                                                <button type="submit" class="dropdown-item block-button">
                                                    <i class="fas fa-ban text-orange-color"></i> {{ __('profile.block_this_user') }}
                                                </button>
                                            </form>
                                        @endif
                                        
                                    </li>
                                </ul>
                                
                            </div>
        
                            @if($data['is_blocked'])
                                <form action="{{ route('users.unblock') }}" method="POST" class="unblock-user-form">
                                    @csrf
                                    <input type="hidden" name="username" value="{{ $data['username'] }}" required>
                                    <button type="submit" class="btn btn-orange text-white unblock-button">
                                        <i class="fas fa-ban text-white"></i> {{ __('profile.unblock_this_user') }}
                                    </button>
                                </form>
                            @else 
                                <a href="{{ route('messages.chat', ['username' => $data['username']]) }}" class="btn text-light">
                                    <i class="fa-regular fa-comments text-orange-color"></i>
                                </a>
                                
                                <button type="button" class="btn btn-orange text-light" onclick="followUser('{{$data['username']}}')">
                                    <span class="follow_text_btn">
                                        {{ $data['follow_btn_status_text'] }}
                                    </span>
                                </button>
                            @endif 
                        </div>
                    
                    </div>
                @endif 
            @endif
        </div>
    </div>
   </div>




    <div class="container bg-white pb-2">
        <div class="row gap-2">
        
            <div class="col-12">
                <img class="cover_image border border-4 border-white rounded-circle mx-3 mb-1"
                     src="{{ asset($data['cover_image']) }}"
                     alt="Tadween logo..." 
                     width="100">
    
                <h3 class="h5">
                    {{$data['name']}} 
                    {!! $data['is_private'] ? '<i class="fa-solid fa-lock text-orange-color"></i>' : '' !!}
                </h3>
                
                <span class="text-muted" id="getUserName" data-get-username="{{ $data['username'] }}">
                    {{ app()->getLocale() == 'ar' ? $data['username'].'@' : '@'.$data['username'] }}
                </span>
            </div>
    
            <div class="col-12">
                <div class="d-flex gap-3">

                    <a href="{{ ($data['is_been_blocked']) ? '#' : route('followings.index', $data['username']) }}" class="text-decoration-none">
                        <p class="text-orange-color">
                            {{ $data['following_count'] }}
                            <span class="text-grey fw-bold">{{ __('profile.profile_following') }}</span>
                        </p>
                    </a>
                
                    <a href="{{ ($data['is_been_blocked']) ? '#' : route('followers.index', $data['username']) }}" class="text-decoration-none">
                        <p class="text-orange-color">
                            <span class="follower_count">{{ $data['follower_count'] }}</span>
                            <span class="text-grey fw-bold">{{ __('profile.profile_followers') }}</span>
                        </p>
                    </a>
                    
                </div>
            </div>
    
            <div class="col-12">
                <h3 class="text-grey lh-base">{{$data['bio']}}</h3>
            </div>
    
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <i class="fa-solid fa-earth-americas text-grey"></i>
                        <span class="text-muted">{{$data['country']}} / {{$data['city']}}</span>
                    </div>
                    <div class="col-md-6">
                        <i class="fa-solid fa-calendar-days text-grey"></i>
                        <span class="text-muted">{{$data['registered_since']}}</span>
                    </div>
                </div>
            </div>
    
        </div>
    </div>

    @if(!$data['is_profile_locked'] && !$data['is_blocked'] && !$data['is_been_blocked'])
        <div class="container bg-white">
            <div class="row text-center">
            
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                        <button class="nav-link tab-link active" data-tab="userPosts">{{ __('profile.profile_blogs') }}</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link tab-link" data-tab="userPostsReplies">{{ __('profile.profile_replies') }}</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link tab-link" data-tab="userPostsMedia">{{ __('profile.profile_media') }}</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link tab-link" data-tab="userPostsLikes">{{ __('profile.profile_likes') }}</button>
                    </li>
                </ul>
            </div>
        </div>
    @endif


    

    @if(!$data['is_profile_locked'] && !$data['is_blocked'] && !$data['is_been_blocked'])
        <!-- HTML to display posts -->
        <p class="text-center text-muted empty_posts d-none my-5 p-3">{{__('home.posts_empty')}}</p>

        <div class="post-container mt-3" id="display-posts-container"></div>
        <!-- Loading Spinner -->
        <div class="d-none justify-content-center my-3" id="posts_loading_indicator">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>


        <!-- Bootstrap Delete Confirmation Post Modal -->
        @include('posts.delete_post_modal')  
       
    @endif

    @if($data['is_profile_locked'] && !$data['is_blocked'] && !$data['is_been_blocked'])
        <div class="text-center">
            <div class="card p-4">
                <h3 class="text-center"><i class="fas fa-lock text-orange-color"></i></h3>
                <h4 class="text-orange-color">{{ __('profile.protected_posts') }}</h4>
                <p class="mt-3">
                    {{ __('profile.only_followers_can_access', ['username' => $data['username']]) }}
                </p>
            </div>
        </div>
    @endif 



    @if($data['is_blocked'])
        <div class="text-center">
            <div class="card p-4">
                <h3 class="text-center"><i class="fas fa-ban text-orange-color"></i></h3>
                <h4 class="text-orange-color">{{ __('profile.user_blocked') }}</h4>
                <p class="mt-3">
                    {{ __('profile.blocked_user_message') }}
                </p>
            </div>
        </div>
    @endif

    @if($data['is_been_blocked'])
        <div class="text-center">
            <div class="card p-4">
                <h3 class="text-center"><i class="fas fa-ban text-orange-color"></i></h3>
                <h4 class="text-orange-color">{{ __('profile.blocked_title') }}</h4>
                <p class="mt-3">
                    {{ __('profile.blocked_message') }}
                </p>
            </div>
        </div>
    @endif
</div>
@endsection

@section('java_scripts')
    @if(!$data['is_profile_locked'])
            <script src="{{asset('js/posts/display_posts.js?version=1.0')}}"></script>
            <script src="{{asset('js/posts/post_like.js?version=1.0')}}"></script>
            @auth
                <script src="{{asset('js/posts/delete_post.js?version=1.0')}}"></script>
                {{-- <script src="{{asset('js/posts/create_post.js?version=1.0')}}"></script> --}}
            @endauth
    @endif

    
    
    @push('js')
    <script src="{{asset('js/users/follow_user.js?version=1.0')}}"></script>
    <script>
                
        $(document).ready(function() {
            // Block button click event
            $('.block-button').on('click', function(event) {
                event.preventDefault();  // Prevent form submission

                // Show confirmation prompt
                if (confirm("{{ __('profile.are_you_sure_block') }}")) {
                    $('.block-user-form').submit();  // Submit the form if confirmed
                }
            });

            // Unblock button click event
            $('.unblock-button').on('click', function(event) {
                event.preventDefault();  // Prevent form submission

                // Show confirmation prompt
                if (confirm("{{ __('profile.are_you_sure_unblock') }}")) {
                    $('.unblock-user-form').submit();  // Submit the form if confirmed
                }
            });
        });

                        
    </script>
    @endpush
   
    

@endsection