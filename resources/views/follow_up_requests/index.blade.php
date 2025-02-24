@extends('layouts.main_app')

@section('pageTitle')
    {{ __('follow_up_requests.pending_requests') }}
@endsection


@section('content')
<div class="container">


    <div class="bg-white rounded-top-4 p-3 mb-3">
        <div class="row mb-2">
            <div class="col">
                <a href="{{route('home')}}" class="text-decoration-none text-orange-color">
                    <i class="fa-solid fa-arrow-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}"></i>
                </a>
            </div>

            <div class="col text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
                <h3 class="h5">{{ __('follow_up_requests.pending_requests') }}</h3>
            </div>
        </div>
    </div>

    
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($pendingRequests->isEmpty())
        <p class="text-center text-orange-color">{{ __('follow_up_requests.no_pending_requests') }}</p>
    @else

        @if(auth()->user()->is_private())
            <div class="alert alert-info text-center">
                {{ __('follow_up_requests.public_account_auto_accept') }}
            </div>
        @endif
    
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('follow_up_requests.follower') }}</th>
                    <th>{{ __('follow_up_requests.request_date') }}</th>
                    <th>{{ __('follow_up_requests.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingRequests as $request)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('profile', $request->follower->username) }}" class="text-primary text-decoration-none" target="_blank">
                                {{ $request->follower->name }}
                            </a>
                        </td>
                        
                        <td>{{ $request->created_at->diffForHumans() }}</td>
                        <td> 
                            <!-- Approve and Deny buttons using AJAX -->
                            <button data-id="{{ $request->id }}" class="approve-btn btn btn-success btn-sm">
                                <span class="spinner-border spinner-border-sm text-light" style="display: none;"></span> <!-- Hidden Spinner -->
                                {{ __('follow_up_requests.approve') }}
                            </button>
                            
                            <button data-id="{{ $request->id }}" class="deny-btn btn btn-danger btn-sm">
                                <span class="spinner-border spinner-border-sm text-light" style="display: none;"></span> <!-- Hidden Spinner -->
                                {{ __('follow_up_requests.deny') }}
                            </button>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

@section('java_scripts')
    @auth
    <script>
        $(document).ready(function() {
            // Reusable function for handling AJAX requests
            function handleRequest(action, requestId, button) {
                let token = $('meta[name="csrf-token"]').attr('content'); // CSRF token
                
                // Show spinner and disable the button
                button.find('span').show();  // Show spinner
                button.prop('disabled', true); // Disable the button to prevent multiple clicks
    
                $.ajax({
                    url: '/' + action + '/' + requestId,
                    type: 'POST',
                    data: {
                        _token: token,
                        id: requestId
                    },
                    success: function(response) {
                        if (response.code == 1) {
                            // Update toast message
                            $('.toast .toast-body').text(response.msg);
                            var toast = new bootstrap.Toast($('.toast'));
                            toast.show();
                            location.reload(); // Reload page to reflect changes
                        } else {
                            alert(response.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong.';
                        alert(errorMessage);
                    },
                    complete: function() {
                        // Hide spinner and enable the button after request is complete
                        button.find('span').hide();  // Hide spinner
                        button.prop('disabled', false); // Enable button
                    }
                });
            }
    
            // Approve button click
            $('.approve-btn').on('click', function(e) {
                e.preventDefault();
                let requestId = $(this).data('id');
                handleRequest('approve-follow-request', requestId, $(this)); // Pass the button (this) to handleRequest function
            });
    
            // Deny button click
            $('.deny-btn').on('click', function(e) {
                e.preventDefault();
                let requestId = $(this).data('id');
                handleRequest('deny-follow-request', requestId, $(this)); // Pass the button (this) to handleRequest function
            });
        });
    </script>
    
    
    
    @endauth
@endsection

