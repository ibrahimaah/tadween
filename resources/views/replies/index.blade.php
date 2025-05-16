@extends('layouts.main_app')

@section('pageTitle')
Replies
@endsection

@section('content')

<x-page-header title="Replies" route="home" />


<x-reply-componenet 
    :reply="$reply"
    :reply-show-route="route('replies.show', $reply->id)"
/>

@foreach ($reply_children as $reply)
    <x-reply-componenet 
    :reply="$reply"
    :reply-show-route="route('replies.show', $reply->id)"
/> 
@endforeach

@endsection