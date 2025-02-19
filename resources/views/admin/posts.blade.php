@extends('layouts.main_app')

@section('pageTitle')
{{ __('dashboard.posts') }}
@endsection

@section('content')
<div class="container">
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- شبكة البطاقات -->
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                
                <div class="row">
                    @php
                        $images = json_decode($post->image, true);
                    @endphp

                    @if (!empty($images) && is_array($images))
                        @foreach ($images as $key => $image)
                            <div class="col">
                                <img src="{{ asset($image) }}" class="img-fluid h-100" alt="Post Image" data-bs-toggle="modal" data-bs-target="#postImageModal{{$key}}">
                            </div>
                            
                        @endforeach
                    @endif
                </div>
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fa-regular fa-user text-orange-color"></i>
                        {{ $post->user->name }}
                    </h6>
                    <p class="card-text text-grey mt-3">{{ Str::limit($post->text, 200) }}</p>
                    <p class="mb-0 text-grey">{{ $post->created_at }}</p>
                </div>
                <div class="card-footer text-end">
                    
                    <form action="{{ route('admin.deletePost', $post->id) }}" method="POST" onsubmit="return confirm('{{__('dashboard.confirm_message_delete')}}');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">{{__('dashboard.delete')}}</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- روابط التقسيم -->
    <div class="d-flex justify-content-center mt-4" style="direction: ltr;">
        {{ $posts->links() }}
    </div>
</div>
@endsection

 
