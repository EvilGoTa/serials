<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Панель администратора - Sarafan.ru</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- Material Dashboard CSS -->
    <link rel="stylesheet" href="/css/material_dashboard/material-dashboard.css">

    <link rel="stylesheet" href="/css/admin.css">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="azure" data-background-color="white" data-image="/img/material_dashboard/sidebar-1.jpg">
        <div class="logo">
            <a href="#" class="simple-text logo-normal">
                Sarafan
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item ">
                    <a class="nav-link" href="#">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#">
                        <i class="material-icons">face</i>
                        <p>Пользователи</p>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin::serials.index') }}">
                        <i class="material-icons">library_books</i>
                        <p>Сериалы</p>
                    </a>
                </li>
            </ul>
        </div>


    </div>
    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#pablo">{{ $content_title or '' }}</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <form class="navbar-form">
                        <span class="bmd-form-group">
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Поиск...">
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </span>
                    </form>
                    <ul class="navbar-nav">
                        {{--<li class="nav-item dropdown"> *}
                            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">notifications</i>
                                <span class="notification">5</span>
                                <p class="d-lg-none d-md-block">
                                    Some Actions
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Mike John responded to your email</a>
                                <a class="dropdown-item" href="#">You have 5 new tasks</a>
                                <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                                <a class="dropdown-item" href="#">Another Notification</a>
                                <a class="dropdown-item" href="#">Another One</a>
                            </div>
                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Аккаунт
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

<!--   Core JS Files   -->
<script src="/js/material_dashboard/core/jquery.min.js"></script>
<script src="/js/material_dashboard/core/popper.min.js"></script>
<script src="/js/material_dashboard/core/bootstrap-material-design.min.js"></script>

<!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
<script src="/js/material_dashboard/plugins/bootstrap-notify.js"></script>

<!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
<script src="/js/material_dashboard/plugins/chartist.min.js"></script>

<!-- Plugin for Scrollbar documentation here: https://github.com/utatti/perfect-scrollbar -->
<script src="/js/material_dashboard/plugins/perfect-scrollbar.jquery.min.js"></script>

<!-- Material Dashboard Core initialisations of plugins and Bootstrap Material Design Library -->
<script src="/js/material_dashboard/material-dashboard.js?v=2.1.0"></script>
</body>
</html>