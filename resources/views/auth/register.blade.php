@extends('layouts.app')

@section('pageTitle')
{{ __('auth.register_field') }}
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 d-none d-md-block">
            <img src="{{asset('img/theme-10-bg-1.webp')}}" alt="Tadween logo..." class="img-fluid h-100">
        </div>
        <div class="col-md-6">
            <form method="POST" class="auth" action="{{ route('register') }}">
                @csrf
                <div class="my-3 text-center">
                    <img src="{{asset('img/logo.webp')}}" width="70" alt="Tadween logo..." class="img-fluid">
                </div>

                <div class="mb-5 text-center">
                    <h3 class="mb-4">{{ __('auth.register_field') }}</h3>
                    <p class="">{{ __('auth.register_info_field') }}</p>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('auth.full_name_field') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">{{ __('auth.username_field') }}</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('auth.email_field') }}</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('auth.password_field') }}</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">{{ __('auth.password_confirmation_field') }}</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="mb-5 form-check {{ app()->getLocale() == 'ar' ? 'form-check-reverse' : '' }}">
                    <input class="form-check-input" type="checkbox" value="1" id="terms" name="terms">
                    <label class="form-check-label" for="terms">
                        {{ __('auth.terms_agree_field') }}
                        <a href="{{ route('terms') }}" class="text-decoration-none" target="_blank">{{ __('auth.terms_and_conditions_field') }}</a>
                        ,
                        <a href="{{ route('privacy') }}" class="text-decoration-none" target="_blank">{{ __('auth.privacy_policy_field') }}</a>.
                    </label>
                    @error('terms')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn w-100">{{ __('auth.create_account_field') }}</button>
            </form>
            <div class="text-center mt-4">
                <p>{{ __('auth.already_have_account_field') }} <a href="{{ route('login') }}" class="text-decoration-none">{{ __('auth.login_field') }}</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
