@extends('layouts.main_app')

@section('pageTitle')
{{ __('follows.followings') }}
@endsection

@section('content')
<div class="follow">
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
                <h3 class="h5">{{ __('follows.followings') }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white mt-2 rounded-top-4">
        <!-- HTML to display follows -->
        <p class="text-center text-muted empty_follows d-none my-5 p-3">{{__('follows.not_found_followings')}}</p>

        <div class="follows-container mt-3" id="display-follows-container"></div>
        <!-- Loading Spinner -->
        <div class="d-none justify-content-center my-3" id="follows_loading_indicator">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

</div>
@endsection

@section('java_scripts')
    <script src="{{asset('js/users/display_followers.js?version=1.0')}}"></script>
    <script src="{{asset('js/users/follow_user.js?version=1.0')}}"></script>
@endsection