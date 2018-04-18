<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link href="/css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="/css/morris.css" type="text/css"/>
    <script src="/js/jquery.nicescroll.js"></script>
    <script src="/js/scripts.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
</head>
<div class="sidebar-menu">
    <header class="logo1">
        <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a>
    </header>
    <div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
    <div class="menu">
        <ul id="menu" >
            <li><a href="/admin/dashboard"><i class="fa fa-tachometer"></i> <span>Dashboard</span><div class="clearfix"></div></a></li>
            {{--<li id="menu-academico" ><a href="{{ url('/members') }}"><i class="fa fa-users" aria-hidden="true"></i><span>Members</span><div class="clearfix"></div></a></li>--}}
            {{--<li id="Li2" ><a href="{{ url('/admin/projectlist/5') }}"><i class="fa fa-list-ul" aria-hidden="true"></i><span> Projects</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>--}}
                {{--<ul id="menu-academico-sub" >--}}
                    {{--<li id="Li3" ><a href="/admin/projectlist/1">Funded</a></li>--}}
                    {{--<li id="Li3" ><a href="/admin/projectlist/2">Non Funded</a></li>--}}
                    {{--<li id="Li4" ><a href="/admin/projectlist/3">Complete</a></li>--}}
                    {{--<li id="Li4" ><a href="/admin/projectlist/4">Ongoing</a></li>--}}
                    {{--<li id="Li4" ><a href="/admin/projectlist/5">All</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li id="Li2" ><a href="{{ url('/researches') }}"><i class="fa fa-list-ul" aria-hidden="true"></i><span> Research</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>--}}
                {{--<ul id="menu-academico-sub" >--}}
                    {{--<li id="menu-academico-avaliacoes" ><a href="icons.html">All</a></li>--}}
                    {{--<li id="Li3" ><a href="typography.html">Funded</a></li>--}}
                    {{--<li id="Li4" ><a href="faq.html">Complete</a></li>--}}
                    {{--<li id="Li4" ><a href="faq.html">Ongoing</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li><a href="{{ url('/publications') }}"><i class="fa fa-table"></i><span>Publications</span><div class="clearfix"></div></a></li>--}}
            {{--<li id="Li2" ><a href="javascript:void(0);"><i class="fa fa-list-ul" aria-hidden="true"></i><span> Supporting Documents</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>--}}
                {{--<ul id="menu-academico-sub" >--}}
                    {{--<li id="menu-academico-avaliacoes" ><a href="/admin/sd/dataset">Dataset</a></li>--}}
                    {{--<li id="Li3" ><a href="/admin/sd/src">Source Code</a></li>--}}
                    {{--<li id="Li4" ><a href="/admin/sd/srs">SRS</a></li>--}}
                    {{--<li id="Li4" ><a href="/admin/sd/other">Other</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li><a href="{{ url('/eventlist') }}"><i class="fa fa-table"></i>  <span>Events</span><div class="clearfix"></div></a></li>--}}

        </ul>
    </div>
</div>
<div class="clearfix"></div>

<script>
    var toggle = true;
    $(".sidebar-icon").click(function () {
        if (toggle) {
            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
            $("#menu span").css({ "position": "absolute" });
        }
        else {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            setTimeout(function () {
                $("#menu span").css({ "position": "relative" });
            }, 400);
        }

        toggle = !toggle;
    });
</script>
