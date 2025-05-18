@extends('layouts.main_app')

@section('pageTitle', __('Post Details'))


@section('content')
<div class="post-container">

    <x-page-header title="" route="home" />

    <div class="mt-2" id="display-posts-container">

        <x-alert-error />

        @isset($post)
        <x-post-component :$post />
        @else
        <p>🙏</p>
        @endisset
    </div>

    <!-- Create Reply On Posts -->
    {{-- @auth --}}
    <x-reply-form-component   
        :post-slug-id="$post->slug_id" 
    />
    {{-- @endauth --}}
</div>
@endsection

@push('js')
    <script src="{{asset('js/posts/render_reply.js')}}"></script>
    <script src="{{asset('js/posts/display_replies_post.js')}}"></script>
    <script src="{{asset('js/posts/create_reply_post.js')}}"></script> 
    <script src="{{asset('js/posts/create_vote_poll.js?version=1.0')}}"></script> 
@endpush