@extends('layouts.main_app')

@section('pageTitle')
{{ __('home.home') }}
@endsection

@section('content')

<div class="post-container">
    <!-- Bootstrap Delete Confirmation Post Modal -->
    @include('posts.delete_post_modal',['slugId'=>$post['slug_id']])
    
    <x-page-header title="{{ __('home.home') }}" route="home" />


    

    <div class="mt-2" id="display-posts-container">

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (!empty($post))
            <x-post-component :$post/>
        @else
            <p>🙏</p>
        @endif
    </div>

    <!-- Create Reply On Posts -->
    {{-- @auth --}}
    @include('partials.reply._reply-form',['post' => $post])
    {{-- @endauth --}}

    

</div>

@endsection

@section('java_scripts')
    <script src="{{asset('js/posts/display_replies_post.js?version=1.0')}}"></script>
    {{-- <script src="{{asset('js/posts/post_like.js')}}"></script> --}}
    @auth
        {{-- <script src="{{asset('js/posts/delete_post.js?version=1.0')}}"></script> --}}
        {{-- <script src="{{asset('js/posts/create_reply_post.js?version=1.0')}}"></script> --}}
        {{-- <script src="{{asset('js/posts/create_post.js?version=1.0')}}"></script> --}}
        <script src="{{asset('js/posts/create_vote_poll.js?version=1.0')}}"></script>
    @endauth

    
@endsection