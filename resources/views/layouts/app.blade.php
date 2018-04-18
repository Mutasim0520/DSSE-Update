<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin|DSSE</title>
    <link rel="stylesheet" href="/css/admin/bootstrap.min.css">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="/css/admin/style.css" rel='stylesheet' type='text/css' />
    <link href="/css/admin/style-responsive.css" rel="stylesheet" />
        <!-- font-awesome icons -->
    <link rel="stylesheet" href="/css/admin/font.css" type="text/css" />
    <link href="/css/admin/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin/morris.css" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- calendar -->
    <link rel="stylesheet" href="/css/admin/monthly.css">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('stylesheet')
</head>
<body>
<section id="container">
    <!--header start-->
    @if(Auth::user())
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <div class="brand">
            <a href="index.html" class="logo">DSSE
            </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>

        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-tasks"></i>
                        <span class="badge bg-success" id="Notification"></span>
                    </a>
                    <ul class="dropdown-menu extended tasks-bar">
                        <li>
                            <p class="" id="notification_text"></p>
                        </li>
                        {{--<li>--}}
                            {{--<a href="javascript:void(0);">--}}
                                {{--<div class="task-info clearfix">--}}
                                    {{--<div class="desc pull-left">--}}
                                        {{--<h5>Target Sell</h5>--}}
                                        {{--<p>25% , Deadline  12 June’13</p>--}}
                                    {{--</div>--}}
                                    {{--<span class="notification-pie-chart pull-right" data-percent="45">--}}
                            {{--<span class="percent"></span>--}}
                            {{--</span>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="external">--}}
                            {{--<a href="#">See All Tasks</a>--}}
                        {{--</li>--}}
                    </ul>
                </li>
            </ul>
            <!--  notification end -->
        </div>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->

            <!--  notification end -->
        </div>
        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <li>
                    <input type="text" class="form-control search" placeholder=" Search">
                </li>
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                        <span class="username">ADMIN DSSE</span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-key"></i>
                                Log Out
                                <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- user login dropdown end -->

            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse">
            <!-- sidebar menu start-->
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a class="active" href="/admin/index">
                            <i class="fa fa-dashboard"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/projectlist/5">
                            <i class="fa fa-list"></i>
                            <span>Project List</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/publications">
                            <i class="fa fa-list"></i>
                            <span>Publications</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/eventlist') }}">
                            <i class="fa fa-table"></i>Events
                        </a>
                    </li>
                </ul>
            </div>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    @endif
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            @include('partials._messages')
            @yield('content')

        </section>
        <!-- footer -->
        <div class="footer">
            <div class="wthree-copyright">
                <p>© 2017 360degreesoftware. All rights reserved | Developed by <a href="http://soft360d.com">360degreesoftware</a></p>
            </div>
        </div>
        <!-- / footer -->
    </section>
    <!--main content end-->
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/js/admin/jquery.dcjqaccordion.2.7.js"></script>
<script src="/js/admin/scripts.js"></script>
<script src="/js/admin/jquery.slimscroll.js"></script>
<script src="/js/admin/jquery.nicescroll.js"></script>
<script src="/js/admin/jquery.scrollTo.js"></script>
<!-- calendar -->
<script type="text/javascript" src="/js/admin/monthly.js"></script>
<script type="text/javascript">
</script>
    <script src="/js/admin/raphael-min.js"></script>
    <script src="/js/admin/morris.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <?php
        use App\User as User;
        $User  = User::where(['status' => 'Pending'])->get();
        $size = sizeof($User);
    ?>

    <script>
        $(document).ready(function () {
            var newRequest = parseInt({{$size}});
            if(newRequest>0){
                $('#notification_text').text('You have '+ newRequest +' new membership request');
                $('#Notification').text(newRequest);
            }
            else {
                $('#notification_text').text('You have no new membership request');
            }
        });
    </script>
    @yield('scripts')
    <!-- Scripts -->
</body>
</html>
