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

@yield('content')

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