@extends('layouts.admin_login')

@section('content')
<div class="wrapper">
    <div class="main-panel" style="width: 100%">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-xs-8" style="margin-left: 33%">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h1 class="card-title">
                                    Авторизация
                                </h1>
                                <p class="card-category">
                                    кто это у нас тут?
                                </p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('login') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="admin" value="1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group bmd-form-group">
                                                <label class="bmd-label-static">Email</label>
                                                <input type="email" class="form-control disable-autofill" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group bmd-form-group">
                                                <label class="bmd-label-static">Пароль</label>
                                                <input type="password" class="form-control disable-autofill" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" value="" name="remember">
                                                    Запомнить меня
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right">Вход<div class="ripple-container"></div></button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection