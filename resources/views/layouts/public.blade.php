<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sarafan</title>

    <!-- Compiled css (bootstrap) -->
    <link href="/css/app.css" rel="stylesheet">
    <!-- common css -->
    <link href="/css/user.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <link href="/css/nouislider.css" rel="stylesheet">
    <link href="/css/featherlight.min.css" rel="stylesheet">
    <link href="/css/tooltipster.bundle.min.css" rel="stylesheet">
    <link href="/css/tooltipster/themes/tooltipster-sideTip-borderless.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="top-header">
    <div class="header-picture er" class="parallax-window" data-parallax="scroll" data-position="top center" data-speed="0.7" data-image-src="@yield('main_image')" ></div>
    <div class="header-tint"></div>
    <div class="container">
        <div class="row header-first-row" style="display: flex; align-items: center; margin-bottom: 20px">
            <div class="col-lg-4  col-sm-2 col-xs-2 xs-no-padding-right">
                <a href="/" class="hidden-xs"><img class="logo" src="/img/sar_ful1.svg" alt="" style=""></a>
                <a href="/" class="visible-xs-block"><img class="logo" src="/img/sar_mob_new.svg" alt="" style=""></a>
            </div>
            <div class="col-lg-4  col-sm-8 col-xs-8">
                <div class="search-wrapper">
                    <form action="/search" class="search-form">
                        <input type="text" name="query" placeholder="Что ищем?">
                        <input type="submit" value="">
                    </form>
                    <p>или <a href="#" data-toggle="modal" data-target="#paramsModal">подберите сериал по параметрам</a></p>
                </div>

            </div>
            <div class="col-lg-3 hidden-xs">
                <ul class="header-links">
                    <li style="border-right: 1px solid white; margin-right: 10px">
                        <a class="header-link" href="/#mixes">Миксы</a>
                    </li>
                    <li>
                        <a class="header-link" href="{{ route('serial_front', ['id' => $random_serial->id]) }}">Случайный сериал</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-1  col-sm-2 col-xs-2">
                <div class="text-right">
                    <a href="#" class="menu-button menu-toggle"></a>
                </div>
            </div>
        </div>
        @yield('header')
    </div>
</div>

@yield('content')

<div class="container footer-words">
    <div class="row">
        <div class="col-lg-12">
            <h2>Миссия</h2>
            <p>
                <strong>Saraphan.ru</strong> - лаконичный и простой сервис для поиска сериалов. Мы убеждены, что никто не может однозначно ответить, хорош сериал или плох. Вместо этого мы предлагаем подобрать, что посмотреть, исходя из ваших личных предпочтений.   Ищите похожие сериалы, подбирайте их по параметрам и ставьте оценки - так вы поможете другим сериаломанам.   По вопросам поддержки пишите на support@saraphan.ru, предложения направляйте на best@saraphan.ru
            </p>
        </div>
    </div>
</div>

<!-- Side menu -->
<div id="side-menu">


            <div class="row">
                @if(!Auth::check())
                <div class="col-xs-12 menu-buttons-wrapper">
                    {{-- <div>
                        <a href="{{ route('register') }}" class="bordered_button button-regular"><span>Присоединиться</span></a>
                    </div> --}}
                    <div>
                        <a href="{{ route('login') }}" class="button-gradient button_arrow-right">Войти</a>
                    </div>
                </div>
                @else
                <div class="col-xs-12">
                    <div>
                        <form action="{{ route('logout') }}" method="post">
                            {{ csrf_field() }}
                            <input type="submit" class="button-gradient logout_button" value="Выйти">
                        </form>

                    </div>
                </div>
                @endif
                <div class="col-xs-12">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Избранное</a>
                            <a href="" class="closer menu-toggle"></a>
                        </li>
                        <li class="visible-xs-block">
                            <a href="/#mixes">Миксы</a>
                        </li>
                        <li class="visible-xs-block hidden-sm">
                            <a href="{{ route('serial_front', ['id' => $random_serial->id]) }}">Cлучайный сериал</a>
                        </li>
                        <li>
                            <a href="{{ route('params') }}">Подбор по параметрам</a>
                        </li>
                        <li>
                            <a href="#">О проекте</a>
                        </li>
                    </ul>
                </div>
            </div>


        {{-- 
            <div class="col-xs-6">
                <div class="menu-tile">
                    @if(Auth::check())
                    <a href="/home">
                        <img src="/img/login.svg" alt="">
                        Личный кабинет
                    </a>
                    @else
                    <a href="/login">
                        <img src="/img/login.svg" alt="">
                        Войти
                    </a>
                    @endif
                </div>
            </div>
            <div class="col-xs-6">
                <div class="menu-tile">
                    <a href="/params">
                        <img src="/img/levels-adjustment.svg" alt="">
                        Подобрать сериал
                    </a>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="menu-tile">
                    <a href="/home">
                        <img src="/img/favorites.svg" alt="" style="filter: invert(100%);">
                        Избранное
                    </a>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="menu-tile">
                    <img src="/img/round-help-button.svg" alt="" style="filter: invert(100%);">
                    <a href="/about">О нас</a>
                </div>
            </div>
         --}}
</div>

<!-- Modal Params -->
<div class="modal fade bd-example-modal-xl" id="paramsModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Подбор по параметрам</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('components.params', ['form_id' => 'paramsForm'])      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary" form="paramsForm">Подобрать</button>
      </div>
    </div>
  </div>
</div>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/app.js"></script>
<script src="/js/nouislider.js"></script>
<script src="/js/featherlight.min.js"></script>
<script src="/js/tooltipster.bundle.min.js"></script>
<script src="/js/parallax.min.js"></script>
<script src="/js/main.js"></script>
@stack('scripts')
</body>
</html>