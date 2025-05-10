@extends('layouts.main_app')

@section('pageTitle', __('home.home'))


@section('content')
<div class="post-container"> 
    
    <x-page-header title="{{ __('home.home') }}" route="home" />

    <div class="mt-2" id="display-posts-container">

        <x-alert-error />

        @isset($post)
            <x-post-component :$post/>
        @else
            <p>🙏</p>
        @endisset
    </div>

    <!-- Create Reply On Posts -->
    {{-- @auth --}}
    @include('partials.reply._reply-form',['post' => $post])
    {{-- @endauth --}}
</div>
@endsection

@push('js')
    <script src="{{asset('js/posts/display_replies_post.js?version=1.0')}}"></script> 
    {{-- @auth  --}}
        <script src="{{asset('js/posts/create_vote_poll.js?version=1.0')}}"></script>
    {{-- @endauth --}}
@endpush