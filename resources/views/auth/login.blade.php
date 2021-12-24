@extends('layouts.slave')

@section('content')
    <section class="form my-4 mx-5">
        <div class="container">
            <div class="row no-gutter">
                <div class="col-lg-5">
                    <img src="{{asset('img/import_export_4-1.jpg')}}" alt="" class="img-fluid">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    {{--                    <img src="logo.png" alt="texa-logo">--}}
                    <h3 class="font-weight-bold py-3">Sign in to your account</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required
                                       autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-6 form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="col-lg-7 form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-row mt-4 justify-content-center">
                            <div class="col-md-10">
                                <button type="submit" class="btn1 mt-2 mb-2">
                                    {{ __('Login') }}
                                </button>
                            </div>

                        </div>
                        <div class="form-row mt-2">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>



{{--                        <div class="form-group mt-3">--}}
{{--                            <button type="submit" class="btn1 mt-2 mb-2">--}}
{{--                                {{ __('Login') }}--}}
{{--                            </button>--}}


{{--                            @if (Route::has('password.request'))--}}
{{--                                <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                    {{ __('Forgot Your Password?') }}--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                        </div>--}}
                    </form>
                </div>
            </div>
        </div>
    </section>




    {{--    <div class="container-fluid vh-100">--}}
    {{--        <div class="row justify-content-center h-100">--}}
    {{--            <div class="card w-25 my-auto shadow">--}}
    {{--                <div class="card-header text-center bg-primary text-white">--}}
    {{--                    <h2>{{__('Login Form')}}</h2>--}}
    {{--                </div>--}}
    {{--                <div class="card-body">--}}
    {{--                    <form method="POST" action="{{ route('login') }}">--}}
    {{--                        @csrf--}}
    {{--                        <div class="form-group">--}}
    {{--                            <label for="email"--}}
    {{--                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}
    {{--                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"--}}
    {{--                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

    {{--                            @error('email')--}}
    {{--                            <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                            @enderror--}}
    {{--                        </div>--}}
    {{--                        <div class="form-group">--}}
    {{--                            <label for="password"--}}
    {{--                                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}
    {{--                            <input id="password" type="password"--}}
    {{--                                   class="form-control @error('password') is-invalid @enderror" name="password" required--}}
    {{--                                   autocomplete="current-password">--}}
    {{--                            @error('password')--}}
    {{--                            <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                            @enderror--}}
    {{--                        </div>--}}
    {{--                        <div class="form-group">--}}
    {{--                            <div class="form-check">--}}
    {{--                                <input class="form-check-input" type="checkbox" name="remember"--}}
    {{--                                       id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

    {{--                                <label class="form-check-label" for="remember">--}}
    {{--                                    {{ __('Remember Me') }}--}}
    {{--                                </label>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="form-group">--}}
    {{--                            <button type="submit" class="btn btn-primary w-100">--}}
    {{--                                {{ __('Login') }}--}}
    {{--                            </button>--}}

    {{--                            @if (Route::has('password.request'))--}}
    {{--                                <a class="btn btn-link" href="{{ route('password.request') }}">--}}
    {{--                                    {{ __('Forgot Your Password?') }}--}}
    {{--                                </a>--}}
    {{--                            @endif--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
