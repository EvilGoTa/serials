<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>404 - Страница не найдена</title>
    <link href="/css/app.css" rel="stylesheet">
    <style>
        .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus, .show > .btn-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgba(0,123,255,.5);
        }
    </style>
</head>

<body>
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 style="margin: 50px;margin-bottom: 15px;max-width: 60%;"><b>404!</b> Это значит, что такой страницы почему-то нет :(</h1>
                <p style="margin: 50px;margin-top: 15px;margin-bottom: 30px;max-width: 55%;">Если вы считаете, что это мы накосячили - сообщите нам об этом с помощью формы ниже. Это нам очень поможет!</p><button class="btn btn-primary" type="button" style="/*margin: auto;*/margin-left: 50px;border-radius: 30px;padding-top: 10px;padding-bottom: 10px;padding-left: 20px;padding-right: 20px;background: linear-gradient(122.11deg, #943601, #3097d1);border: hidden;">Написать нам &nbsp;→<br></button></div>
            <div
                    class="col-md-6">
                <h2 style="margin: 50px;max-width: 60%;color: #212529;">Советуем посмотреть:</h2><a href="/#mixes" style="padding: 15px;padding-left: 50px;color: black;">Миксы</a>
                <hr><a href="{{ route('serial_front', ['id' => $random_serial->id]) }}" style="padding: 15px;padding-left: 50px;color: black;">Случайный сериал</a>
                <hr><a href="{{ route('params') }}" style="padding: 15px;padding-left: 50px;color: black;">Подбор по параметрам</a></div>
        </div>
    </div>
</div>
<script src="/js/app.js"></script>
</body>

</html>