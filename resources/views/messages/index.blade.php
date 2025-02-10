@extends('layouts.main_app')

@section('pageTitle')
{{ __('messages.messages') }}
@endsection

@section('content')
<div class="message">
    <div id="pullToRefreshIndicator" class="text-center d-none justify-content-center">
        <i class="fa fa-spinner fa-spin text-orange-color h1 py-3"></i>
    </div>
    <div class="bg-white rounded-top-4 p-3">
        <div class="row mb-2">
            <div class="col">
                <a href="{{route('home')}}" class="text-decoration-none text-orange-color">
                    <i class="fa-solid fa-arrow-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}"></i>
                </a>
            </div>

            <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                <h3 class="h5">{{ __('messages.messages') }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white mt-2">
        <!-- HTML to display messages -->
        <p class="text-center text-muted empty_messages d-none my-5 p-3">{{__('messages.not_found_messages')}}</p>

        <div class="messages-container mt-3" id="display-messages-container"></div>
        <!-- Loading Spinner -->
        <div class="d-none justify-content-center my-3" id="messages_loading_indicator">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

</div>
@endsection

@section('java_scripts')
    <script src="{{asset('js/messages/display_messages.js?version=1.0')}}"></script>
@endsection