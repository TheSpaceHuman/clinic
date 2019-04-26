<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Клиника "Здоровье"</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"><!-- ===== styles =====-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!--link(rel="stylesheet", href="https://fonts.googleapis.com/css?family=Raleway:300,400,700")-->
    <link rel="stylesheet" href="public/css/front.css">
</head>

<body>
    

    
    <div class="modal show fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: block;">
        <form method="POST" action="{{ route('login') }}" class="modal-dialog modal-dialog-centered">
            @csrf
            <div class="modal-content">
                <div class="modal-header" style="justify-content: center;flex-wrap: wrap;flex-direction: column;">
                    <img src="/public/image/index/logo.png" >
                    <br>
                    <h4 class="modal-title" id="exampleModalCenterTitle" style="text-align: center;display: block;margin: 0 auto;    ">Авторизация</h4>
                </div>
                <div class="modal-body">
                <div class="col-md-12">
                    <input id="email" type="email" placeholder="Ваш email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback text-center" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-12">
                    <input id="password" type="password" placeholder="Ваш пароль" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback text-center" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <input type="hidden" name="action" value="auth/formLogin" />
                <input type="hidden" name="return" value="" />
                <div class="modal-footer flex-column align-items-center mb-0">
                    <button type="submit" class="btn btn-green mx-auto">{{ __('Login') }}</button>
                    <div class="my-5">
                        <a href="{{ url('/register') }}" class="text-center">Хочу зарегистрироваться</a>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </div>

<footer class="footer-index">
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="navbar-brand"><a href="index.html"><img src="/public/image/index/logo-footer.png"></a></div>
                </div>
                <div class="col-4 offset-5 footer_info">
                    <div class="footer_info_items">
                        <div class="footer_info_item">
                            <p class="text">Служба поддержки:</p>
                        </div>
                        <div class="footer_info_item"><a class="email link-def" href="mailto:info@sitedo.ru">info@sitedo.ru</a></div>
                        <div class="footer_info_item"><a class="phone link-def" href="tel:+74957403312">+7 495 740 33 12</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </footer>
    <script src="/public/js/front.js"></script>
</body>

</html>

{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
