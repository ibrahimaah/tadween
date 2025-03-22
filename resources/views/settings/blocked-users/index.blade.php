@extends('layouts.main_app')

@section('pageTitle')
    {{ __('settings.blocked_users') }}
@endsection

@section('content')

<x-page-header title="settings.blocked_users" route="settings" />
<div class="container">

    @forelse ($blockedUsers as $blockedUser)
        @php 
            $blockedUsername = $blockedUser->blockedUser->username;
        @endphp 
    
    <x-blocked-user-card :blockedUser="$blockedUser" :blockedUsername="$blockedUsername" />

    @empty
        <div class="alert alert-warning mt-5 text-center">
            {{ __('messages.no_blocked_users') }}
        </div>
    @endforelse
    
    
</div>
@endsection

@push('js') 
<script>
            
    $(document).ready(function() { 

        // Unblock button click event
        $('.unblock-button').on('click', function(event) {
            event.preventDefault();  // Prevent form submission

            // Show confirmation prompt
            if (confirm("{{ __('profile.are_you_sure_unblock') }}")) {
                $('.unblock-user-form').submit();  // Submit the form if confirmed
            }
        });
    });

                    
</script>
@endpush