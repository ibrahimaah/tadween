@extends('layouts.main_app')

@section('pageTitle')
Replies
@endsection

@section('content')

<x-page-header title="Replies" route="home" />

<x-reply 
    :reply="$reply"
    :reply-show-route="route('replies.show', $reply->id)"
/>

@endsection