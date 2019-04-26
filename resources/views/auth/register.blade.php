<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Клиника "Здоровье" Регистрация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- ===== styles =====-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/front.css">
</head>

<body>



<div class="modal show fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: block;">
    <form method="POST" action="{{ route('register') }}" class="modal-dialog modal-dialog-centered">
        @csrf
        <div class="modal-content">
            <div class="modal-header" style="justify-content: center;flex-wrap: wrap;flex-direction: column;">
                <img src="/public/image/index/logo.png" >
                <br>
                <h4 class="modal-title" id="exampleModalCenterTitle" style="text-align: center;display: block;margin: 0 auto;    ">Регистрация</h4>
            </div>

            <div class="modal-body">
                <div class="col-md-12">
                    <input id="name" type="text" placeholder="Ваш имя" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback text-center" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-12">
                    <input id="email" type="email" placeholder="Ваш email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
                <div class="col-md-12">
                    <input id="password-confirm" type="password" placeholder="Повторите пароль" class="form-control" name="password_confirmation"  required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-green">Регистрация</button>
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




