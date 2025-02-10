@extends('layouts.app')

@section('pageTitle')
{{ __('auth.forgot_password_label') }}
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <form method="POST" class="auth bg-light shadow p-4" action="{{ route('password.email') }}">
                @csrf
                <h3 class="mb-5 text-center">{{ __('auth.forgot_password_label') }}</h3>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('auth.email_field') }}</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    @error('email')
                        <small class="text-danger my-2">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="mt-5 btn w-100">{{ __('auth.send_reset_link') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
