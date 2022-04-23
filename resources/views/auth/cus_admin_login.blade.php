
@extends('layouts.app')

@section('content')


<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('template/admin/assets/img/favicon.ico') }}"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('template/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('template/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('template/assets/css/authentication/form-2.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('template/assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('template/assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css" >
</head>

<style>
.form-container {
    margin-top: 50px;
    margin-bottom: 50px;
}
</style>

<body class="form">

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class=""> {{ isset($url) ? ucwords($url) : ""}} {{ __('Login') }}</h1>
                        <p class="">Log in to your account to continue.</p>
                        @isset($url)
                            <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
                            @else
                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @endisset
                                @csrf
                        <form class="text-left">
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="e.g John_Doe" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                 {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">{{ __('Password') }}</label>
                                         {{-- @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="forgot-pass-link">{{ __('Forgot Your Password?') }}</a>
                                        @endif --}}
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password"  type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                     @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                {{-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> --}}

                                <div class="d-flex justify-content-between">
                                    <div class="form-group row">
                                            <div class="form-check">
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                                <input class="form-check-input col-md-12 offset-md-4" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            </div>
                                    </div>
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">  {{ __('Login') }}</button>
                                    </div>
                                </div>

                                <div class="division">
                                      <span>OR</span>
                                </div>

                                <div class="social">
                                    <a href="javascript:void(0);" class="btn social-fb">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                        <span class="brand-name">Facebook</span>
                                    </a>
                                   <a href="javascript:void(0);" class="btn social-github">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                                        <span class="brand-name">Github</span>
                                    </a>
                                </div>

                                <p class="signup-link">Not registered ?  <a href="/register/admin">Create an account</a></p>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('template/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/authentication/form-2.js') }}"></script>

</body>




@endsection
