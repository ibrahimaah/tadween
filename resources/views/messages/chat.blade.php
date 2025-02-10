@extends('layouts.main_app')

@section('pageTitle')
{{ __('messages.messages') }}
@endsection

@section('content')

<div class="post-container">
    <div class="bg-white rounded-top-4 p-3">
        <div class="row mb-2">
            <div class="col">
                <a href="{{route('messages.index')}}" class="text-decoration-none text-orange-color">
                    <i class="fa-solid fa-arrow-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}"></i>
                </a>
            </div>
            <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                <p class="text-muted mb-0">
                    {{ __('messages.messages') }}
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white mt-2">

        <!-- Loading Spinner -->
        <button class="btn btn-primary w-100 justify-content-center" type="button"  id="messages_loading_indicator" disabled>
            <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
            <span class="visually-hidden" role="status">Loading...</span>
        </button>
        
        <!-- HTML to display messages -->
        <p class="text-center text-muted empty_messages d-none">{{__('messages.not_found_messages')}}</p>

        <div style="height: 400px;overflow-y: auto;" id="display-messages-container"
            data-receiver-username="{{ $username }}"
            data-sender-username="{{ Auth::user()->username }}">
        </div>

        <div class="input-group mb-3 p-2">
            <button id="send" class="btn btn-orange {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-end' : '' }}" type="button" id="button-addon1">
                <i class="fa fa-paper-plane text-light" aria-hidden="true"></i>
            </button>
            <input type="text" id="message" class="form-control {{ app()->getLocale() == 'ar' ? 'rounded-0 rounded-start' : '' }}" placeholder="">
        </div>
        
    </div>
</div>

@endsection

@section('java_scripts')
    @auth
    <script src="{{asset('js/messages/chat.js?version=1.0')}}"></script>
    @endauth
@endsection