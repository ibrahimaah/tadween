@extends('layouts.main_app')

@section('pageTitle')
    {{ __('settings.blocked_users') }}
@endsection

@section('content')

<x-page-header title="settings.blocked_users" route="settings" />
<div class="container">

    @forelse ($blockedUsers as $blockedUser)
        @php 
            $blockedUsername = $blockedUser->username;
        @endphp 
    
    <x-blocked-user-card :blockedUser="$blockedUser" />

    @empty
        <div class="alert alert-warning mt-5 text-center">
            {{ __('messages.no_blocked_users') }}
        </div>
    @endforelse
    
    
</div>

@endsection
 


 

