<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Indigenous People Registry Information System</title>
        <script src="https://kit.fontawesome.com/dc8985d071.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            html, body {
                background-color: #fff;
                background-image: url('/img/bg.jpg');
                background-size: cover;
                background-repeat: inherit;
                color: #636b6f;
                font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-left {
                align-items: center;
                display: flex;
                float: left;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .card-header{
                width: 85%;
                position: relative;
                bottom: 20px;
                left: 30px;
                border-radius: 0.90em;
                color: #fff;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-left position-ref full-height">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 offset-md-9">
                        <div class="card">
                            <div class="card-header rounded bg-success">
                                <h6>WELCOME</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row justify-content-center pb-2">
                                            <img src="{{ URL::asset('img/logo.png') }}" width="100" height="100" alt="doh credits Logo">
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-12 col-form-label text-md-left"><i class="fas fa-user-circle"></i> Username</label>
            
                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="password" class="col-md-12 col-form-label text-md-left"><i class="fas fa-key"></i> Password</label>
            
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                        <div class="col-md-12">
                                            <a class="btn btn-link" href="{{ route('home') }}">
                                                        {{ __('Log-in as Guest') }}
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </body>
</html>
