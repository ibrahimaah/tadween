@extends('layouts.main_app')

@section('pageTitle')
{{ __('home.home') }}
@endsection

@section('content')

<div class="post-container">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div id="pullToRefreshIndicator" class="text-center d-none justify-content-center">
        <i class="fa fa-spinner fa-spin text-orange-color h1 py-3"></i>
    </div>

    <!-- Bootstrap Delete Confirmation Post Modal -->
    @include('posts.delete_post_modal')


    <!-- HTML to display posts -->
    <p class="text-center text-muted empty_posts d-none">{{__('home.posts_empty')}}</p>

    <div id="display-posts-container"></div>

    <!-- Loading Spinner -->
    <div class="d-none justify-content-center my-3" id="posts_loading_indicator">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</div>

@endsection

@section('java_scripts')
    <script src="{{asset('js/posts/display_posts.js?version=1.0')}}"></script>
    <script src="{{asset('js/posts/post_like.js?version=1.0')}}"></script>
    @auth
    <script src="{{asset('js/posts/delete_post.js?version=1.0')}}"></script>
    <script src="{{asset('js/posts/create_post.js?version=1.0')}}"></script>
    @endauth
@endsection
