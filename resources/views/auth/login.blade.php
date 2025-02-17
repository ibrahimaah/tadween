@extends('layouts.app')

@section('pageTitle')
{{ __('auth.login_field') }}
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 d-none d-md-block">
                <img src="{{asset('img/logo.webp')}}" alt="Tadween logo..." class="img-fluid h-100" width="300">
            </div>
            <div class="col-md-6">
                <form action="{{ route('login') }}" class="auth bg-light p-3 shadow" method="POST">
                    @csrf
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mt-3 text-center">
                        <img src="{{asset('img/logo.webp')}}" width="70" alt="Tadween logo..." class="img-fluid">
                    </div>

                    <div class="mt-3 text-center">
                        <h2 class="mb-4">{{ __('auth.login_welcome_field') }}</h2>
                        <h3 class="mb-4">{{ __('auth.login_field') }}</h3>
                    </div>

                    <div class="mb-4">
                        <label for="login" class="form-label text-muted">{{ __('auth.email_username_field') }}</label>
                        <input type="text" class="form-control" id="login" name="login"  value="{{ old('login') }}" required>
                        
                        @error('login')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-muted">{{ __('auth.password_field') }}</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-center my-4">
                        <p>{{ __('auth.forgot_password_field') }} <a href="{{ route('password.request') }}" class="text-decoration-none">{{ __('auth.reset_password_field') }}</a></p>
                    </div>

                    <button type="submit" class="btn w-100">{{ __('auth.login_field') }}</button>

                    <div class="text-center mt-5">
                        <p>{{ __('auth.not_have_account_field') }} <a href="{{ route('register') }}" class="text-decoration-none">{{ __('auth.create_account_field') }}</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection