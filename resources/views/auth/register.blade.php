@extends('layouts.auth')

@section('content')
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="{{ route('login') }}" class="navbar-brand navbar-brand-autodark">
                Aquí añade el logotipo
            </a>
        </div>
        <div class="card card-md">
            
            <div class="card-body">
                <h2 class="h2 text-center mb-4">{{ __('Register to your account') }}</h2>
                <form action="{{ route('register') }}" method="post" autocomplete="off" novalidate="">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">{{ __('Name') }}</label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center text-secondary mt-3">
            {{ __('Already have an account?') }} <a href="{{ route('login') }}" tabindex="-1">{{ __('Sign in') }}</a>
        </div>
    </div>
@endsection
