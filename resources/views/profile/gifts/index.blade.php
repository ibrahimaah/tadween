@extends('layouts.main_app')

@section('pageTitle')
    {{ __('gifts.title') }}
@endsection


@push('styles')
    <style>
        /* .hidden-gift::after {
            content: "{{ __('gifts.hidden') }}";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold; 
        } */
    </style>
    <link rel="stylesheet" href="{{ asset('css/gifts/gifts_styles.css') }}">  
@endpush

@section('content')


<div class="user_gifts">

    <x-page-header title="gifts.title" />

    <div class="bg-white mt-2 rounded-top-4">

        <div id="pullToRefreshIndicator" class="text-center d-none justify-content-center">
            <i class="fa fa-spinner fa-spin text-orange-color h1 py-3"></i>
        </div>

        <div class="row p-3 g-4 mt-2 mb-4" id="giftsContainer"></div>
        
        <p class="text-center text-muted empty_gifts d-none my-5 p-3">{{__('gifts.no_gifts')}}</p>

    </div>

    <x-modal 
        id="confirmModal" 
        title="{{ __('gifts.ensure_msg') }}" 
        message="" 
        confirmButtonId="confirmBtn" 
    />


</div>
@endsection

@section('java_scripts') 
<script>
    window.giftPageData = {
        currentAuthId: @json(auth()->id()),
        csrfToken: '{{ csrf_token() }}',
        translations: {
            somethingWentWrong: "{{ __('general.something_went_wrong') }}",
            anonymous: "{{ __('gifts.anonymous') }}",
            show: "{{ __('gifts.show') }}",
            hide: "{{ __('gifts.hide') }}",
            delete: "{{ __('gifts.delete') }}",
            areYouSure: {
                show: "{{ __('gifts.are_you_sure_show') }}",
                hide: "{{ __('gifts.are_you_sure_hide') }}",
                delete: "{{ __('gifts.are_you_sure_delete') }}"
            }
        }
    };
</script>
<script src="{{ asset('js/gifts/gifts_scripts.js') }}"></script>
@endsection