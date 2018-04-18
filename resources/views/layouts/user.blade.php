<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="/css/user/layout.css?v=4" rel="stylesheet" type="text/css" media="all">
    <link href="/css/user/academicons.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/user/flexslider.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/user/animate.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="/css/user/owl.carousel.css" type="text/css" media="screen" />

    <link href="/css/user/framework.css" rel="stylesheet" type="text/css" media="all">
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="/js/user/jquery.flexslider.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/user/jquery.backtotop.js"></script>
    <script src="/js/user/jquery.mobilemenu.js"></script>
    <script src="/js/user/jquery.viewportchecker.js"></script>
    <script src="/js/user/responsiveslides.min.js"></script>
    <script src="/js/user/owl.carousel.js"></script>


    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('style')
</head>
<body id="top">
    @include('partials/user._nav')
    @include('partials._messages')
    <div class="wrapper body-container page-wrap" style="">
        @yield('content')
    </div>

    <div class="wrapper row5 site-footer" style="">
        <div class="container">
            <div id="copyright" class="hoc clear">
                <p class="fl_left">Copyright &copy; 2017 - All Rights Reserved - <a href="javascript:void(0);">DSSE Group</a></p>
            </div>
        </div>
</div>
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
    @yield('scripts')
<script>
    $(document).ready(function () {
        @if(Session::has('registration_request_send'))
                   $('#registration_request_send').modal('show');
        @endif
    });
</script>
</body>
</html>
