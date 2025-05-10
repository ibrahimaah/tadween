@extends('layouts.main_app')

@section('pageTitle')
{{ __('home.home') }}
@endsection

@section('content')

<div class="post-container">
    <!-- Bootstrap Delete Confirmation Post Modal -->
    @include('posts.delete_post_modal',['slugId'=>$post['slug_id']])
    
    <!-- Bootstrap Delete Confirmation Modal -->
    <div class="modal fade" id="deleteReplyModal" tabindex="-1" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('home.confirm_delete')}}</h5>
                </div>
                <div class="modal-body">
                <p>{{__('home.reply_confirm_message_delete')}}
                </p>
                <div id="deleteMessageReply"></div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('home.cancel')}}</button>
                    <button type="button" class="btn btn-danger confirm-delete-btn-reply" id="">{{__('home.delete')}}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Show Reply Image Modal -->
    <div class="modal fade" id="replyImageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Preview Image">
                </div>
            </div>
        </div>
    </div>
    

    <x-page-header title="{{ __('home.home') }}" route="home" />


    

    <div class="mt-2" id="display-posts-container">

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (!empty($post))

        <x-post :post=$post/>
        @else
            <p>🙏</p>
        @endif
    </div>

    <!-- Create Reply On Posts -->
    @auth

    

    <div id="errorsContainerReply" class="mb-3"></div>
    
    @include('partials.reply.reply-form',['post' => $post])



    @endauth

    <!-- HTML to display Replies On Post -->
    <p class="text-center text-muted empty_replies d-none">{{__('home.post_replies_empty')}}</p>
    <!-- HTML to display post -->
    <div id="pullToRefreshIndicator" class="text-center d-none justify-content-center">
        <i class="fa fa-spinner fa-spin text-orange-color h1 py-3"></i>
    </div>
    <div class="mt-2" id="display-replies-container"></div>
    
    <!-- Loading Spinner -->
    <div class="d-none justify-content-center my-3" id="replies_loading_indicator">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</div>

@endsection

@section('java_scripts')
    <script src="{{asset('js/posts/display_replies_post.js?version=1.0')}}"></script>
    <script src="{{asset('js/posts/post_like.js?version=1.0')}}"></script>
    @auth
        <script src="{{asset('js/posts/delete_post.js?version=1.0')}}"></script>
        <script src="{{asset('js/posts/create_reply_post.js?version=1.0')}}"></script>
        {{-- <script src="{{asset('js/posts/create_post.js?version=1.0')}}"></script> --}}
        <script src="{{asset('js/posts/create_vote_poll.js?version=1.0')}}"></script>
    @endauth

    
@endsection