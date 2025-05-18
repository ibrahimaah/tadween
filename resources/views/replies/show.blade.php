@extends('layouts.main_app')

@section('pageTitle',__('Replies')) 

@section('content')

<x-page-header :title="__('reply.replies')" route="home" />



@php
    $post = $reply->post;
@endphp
<x-post-component :$post />


@foreach ($reply_parents as $reply_parent)
    <x-reply-componenet 
    :reply="$reply_parent"
    :reply-show-route="route('replies.show', $reply_parent->slug_id)"
/> 
@endforeach



<x-reply-componenet 
    :reply="$reply"
    :reply-show-route="route('replies.show', $reply->slug_id)"
/>

 

@foreach ($reply_children as $reply_child)
    <x-reply-componenet 
    :reply="$reply_child"
    :reply-show-route="route('replies.show', $reply_child->slug_id)"
/> 
@endforeach


<x-reply-form-component  
    :post-slug-id="$post->slug_id" 
    :parent-id="$reply->id"
/>

@endsection

@push('js')
    <script src="{{asset('js/posts/render_reply.js')}}"></script>
    <script src="{{asset('js/posts/create_reply_post.js')}}"></script> 
@endpush