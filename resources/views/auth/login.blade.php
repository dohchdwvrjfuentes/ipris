@extends('layouts.app',['titlePage' => __('Login')])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('login') }}">
                            
            @csrf
            @method('post')

            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">

                        @if (session('warning'))
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="alert alert-warning">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <img src="{!! asset('img/close.png') !!}" style="height: 24px; width: 24px;">
                              </button>
                              <span>{{ session('warning') }}</span>
                            </div>
                          </div>
                        </div>
                        @elseif(session('status'))
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <img src="{!! asset('img/close.png') !!}" style="height: 24px; width: 24px;">
                              </button>
                              <span>{{ session('status') }}</span>
                            </div>
                          </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
