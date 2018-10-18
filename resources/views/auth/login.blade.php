@extends('layouts.public')

@section('content')
    <link rel="stylesheet" href="/css/register_form.css">
    <div class="body">
        <div class="veen container">
            <div class="login-btn splits">
                <p>Уже с нами?</p>
                <button class="active">Войти</button>
            </div>
            <div class="rgstr-btn splits">
                <p>Еще нет аккаунта?</p>
                <button>Присоединиться!</button>
            </div>
            <div class="wrapper">
                <form id="login" tabindex="500" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <h3>Войти</h3>
                    <div class="mail {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete="q">
                        <label>Электронная почта</label>
                    </div>
                    <div class="passwd {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="q">
                        <label>Пароль</label>
                    </div>
                    <div class="submit">
                        <button class="dark">Войти</button>
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            Забыли пароль?
                        </a>
                    </div>
                    <input type="checkbox" name="remember" checked style="display: none">
                </form>
                <form id="register" tabindex="502" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <h3>Быстрая регистрация</h3>
                    <div class="name {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus autocomplete="q">
                        <label>Имя (видят другие пользователи)</label>
                    </div>
                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                    <div class="mail {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="q">
                        <label>Электронная почта (никто не видит)</label>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                    <div class="passwd {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="q">
                        <label>Пароль</label>
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif

                    <div class="submit">
                        <button class="dark">Присоединиться</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            $(document).ready(function(){
                $(".veen .rgstr-btn button").click(function(){
                    $('.veen .wrapper').addClass('move');
                    $('.body').css('background','#f5f8fa');
                    $(".veen .login-btn button").removeClass('active');
                    $(this).addClass('active');

                });
                $(".veen .login-btn button").click(function(){
                    $('.veen .wrapper').removeClass('move');
                    $('.body').css('background','#f5f8fa');
                    $(".veen .rgstr-btn button").removeClass('active');
                    $(this).addClass('active');
                });
            });
        </script>
    @endpush

@endsection

@section('header')
    @include('components.header_links')
@endsection

@section('main_image')/img/serials/{{ str_replace(' ', '%20', $random_serial->image) }}@endsection
