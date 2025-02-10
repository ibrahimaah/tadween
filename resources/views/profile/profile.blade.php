@extends('layouts.main_app')

@section('pageTitle')
{{$data['name']}}
@endsection

@section('content')
<div class="profile">
    <div id="pullToRefreshIndicator" class="text-center d-none justify-content-center">
        <i class="fa fa-spinner fa-spin text-orange-color h1 py-3"></i>
    </div>
    <div class="bg-white rounded-top-4 p-3">
        <div class="row mb-2">
            <div class="col">
                <a href="{{route('home')}}" class="text-decoration-none text-orange-color">
                    <i class="fa-solid fa-arrow-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}" id="backPrev"></i>
                </a>
            </div>

            <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                <h3 class="h5 mb-1">{{$data['name']}}</h3>
                <p class="text-grey">
                    {{ __('profile.profile_blogs') }} : {{$data['post_count']}}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <img class="profile_background_image"
                    src="{{ $data['background_image'] == null ? asset('img/logo.webp') : asset($data['background_image']) }}"
                    alt="Tadween logo..."
                >
            </div>
            <div class="col">
                <img class="cover_image border border-4 border-white rounded-circle mx-3"
                src="{{ $data['cover_image'] == null ? asset('img/logo.webp') : asset($data['cover_image']) }}"
                alt="Tadween logo..." width="100">
            
                @if (Auth::check() && !$data['is_owner'])
                <div id="follow{{$data['username']}}" class="col-12 follow_btn_margin text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                    
                    <a href="{{ route('messages.chat', ['username' => $data['username']]) }}" class="btn text-light">
                        <i class="fa-regular fa-comments text-orange-color"></i>
                    </a>
                    
                    <button type="button" class="btn btn-orange text-light" onclick="followUser('{{$data['username']}}')">
                        <span class="follow_text_btn">
                            {{ $data['is_following'] ? __('profile.user_cancel_follow') : __('profile.user_follow') }}
                        </span>
                    </button>
                    
                </div>
                @endif
            </div>
            
            
        </div>

        <div class="row mt-3">
            <div class="col-12 mb-3">
                <h3 class="h5">{{$data['name']}}</h3>
                <span class="text-muted" id="getUserName" data-get-username="{{ $data['username'] }}">
                    {{ app()->getLocale() == 'ar' ? $data['username'].'@' : '@'.$data['username'] }}
                </span>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('followings.index', $data['username']) }}" class="text-decoration-none">
                            <p class="text-orange-color">
                                {{ $data['following_count'] }}
                                <span class="text-grey fw-bold">{{ __('profile.profile_following') }}</span>
                            </p>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('followers.index', $data['username']) }}" class="text-decoration-none">
                            <p class="text-orange-color">
                                <span class="follower_count">{{ $data['follower_count'] }}</span>
                                <span class="text-grey fw-bold">{{ __('profile.profile_followers') }}</span>
                            </p>
                        </a>
                    </div>
                    <div class="col-3 d-none">
                        <h3 class="text-grey fw-bold">{{ __('profile.profile_gift') }}</h3>
                        <p class="text-orange-color">
                            100
                            <span class="text-grey fw-bold">{{ __('profile.profile_gift') }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <h3 class="text-grey lh-base">{{$data['bio']}}</h3>
            </div>

            <div class="col-12 mb-3">
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

</div>
@endsection

@section('java_scripts')
    <script src="{{asset('js/posts/display_posts.js?version=1.0')}}"></script>
    <script src="{{asset('js/posts/post_like.js?version=1.0')}}"></script>
    @auth
    <script src="{{asset('js/posts/delete_post.js?version=1.0')}}"></script>
    <script src="{{asset('js/posts/create_post.js?version=1.0')}}"></script>
    <script src="{{asset('js/users/follow_user.js?version=1.0')}}"></script>
    @endauth
@endsection