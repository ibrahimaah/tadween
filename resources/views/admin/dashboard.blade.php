@extends('layouts.main_app')

@section('pageTitle')
{{ __('dashboard.dashboard') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100 bg-primary bg-opacity-25 mb-3">
                <div class="card-header">{{__('dashboard.users_count')}}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalUsers }}</h5>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100 bg-success bg-opacity-25 mb-3">
                <div class="card-header">{{__('dashboard.posts_count')}}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalPosts }}</h5>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100 bg-warning bg-opacity-25 mb-3">
                <div class="card-header">{{__('dashboard.active_users_count')}}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $onlineUsers }}</h5>
                </div>
            </div>
        </div>
        <!-- حساب عدد الصور في المشاركات -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 bg-info bg-opacity-25 mb-3">
                <div class="card-header">{{__('dashboard.all_posts_images_count')}}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalPostImages }}</h5>
                </div>
            </div>
        </div>
        <!-- حساب عدد صور الغلاف في ملفات تعريف المستخدمين -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 bg-info bg-opacity-25 mb-3">
                <div class="card-header">{{__('dashboard.all_cover_images_count')}}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalProfileCoverImages }}</h5>
                </div>
            </div>
        </div>
        <!-- حساب عدد صور الخلفية في ملفات تعريف المستخدمين -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 bg-info bg-opacity-25 mb-3">
                <div class="card-header">{{__('dashboard.all_background_images_count')}}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalProfileBackgroundImages }}</h5>
                </div>
            </div>
        </div>
        <!-- إجمالي الصور يشمل صور المشاركات وصور ملفات التعريف (الغلاف والخلفية) -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 bg-dark bg-opacity-25 mb-3">
                <div class="card-header">{{__('dashboard.all_images_count')}}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalImages }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('java_scripts')
    @auth
    <script src="{{asset('js/posts/create_post.js?version=1.0')}}"></script>
    @endauth
@endsection