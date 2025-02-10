@extends('layouts.main_app')

@section('pageTitle')
{{ __('notifications.notifications') }}
@endsection

@section('content')
<div class="notifications">
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
                <p class="text-muted">
                    {{ __('notifications.notifications') }}
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white mt-2 rounded-top-4">
        <!-- HTML to display notifications -->
        <p class="text-center text-muted empty_notifications d-none my-5 p-3">{{__('notifications.not_found_notifications')}}</p>

        <div id="display-notifications-container"></div>

        <!-- Loading Spinner -->
        <div class="d-none justify-content-center my-3" id="notifications_loading_indicator">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

</div>
@endsection

@section('java_scripts')
    @auth
    <script src="{{asset('js/notifications/display_notifications.js?version=1.0')}}"></script>
    @endauth
@endsection