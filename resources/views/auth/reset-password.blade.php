@extends('layouts.app')

@section('pageTitle')
{{ __('auth.reset_password_label') }}
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" class="auth bg-light p-4 shadow" action="{{ route('password.update') }}">
                @csrf

                <h3 class="mb-5 text-center">{{ __('auth.reset_password_label') }}</h3>

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('auth.email_field') }}</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('auth.new_password_field') }}</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="form-label">{{ __('auth.password_confirmation_field') }}</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn w-100">{{ __('auth.reset_password_label') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
