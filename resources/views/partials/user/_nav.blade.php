<div class="bgded overlay bd" style="padding-top: 15px;
    height: 80px;
    transition: none;" id="nav_container">
    <div class="container">
        <div class="header-nav">
            <div class="container">
                <nav class="navbar">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="logo" style="margin-top: -12px; width: 20%;">
                            <h2 style="text-decoration: none;"><a style="color: white;" href="/">DSSE</a></h2>
                        </div>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse hudai2 nav-wil" id="bs-example-navbar-collapse-1" style="background-color: #2b2841;">
                         @if(Auth::user())
                               @if(Auth::user()->role == 'Member')
                                <ul class="nav navbar-nav linka">
                                    <li><a href="/" style="color: white;">Home</a></li>
                                    <li class="dropdown">
                                        <a class=" scroll" data-toggle="dropdown" href="#" style="color: white;"><span><i class="fa fa-drop fa-angle-down" aria-hidden="true"></i></span> Projects </a>
                                        <ul class="dropdown-menu hudai">
                                             <li><a href="/PROJECTS/1">Funded</a></li>
                                            <li><a href="/PROJECTS/2">Non Funded</a></li>
                                            <li><a href="/PROJECTS/3">Complete</a></li>
                                            <li><a href="/PROJECTS/4">On-going</a></li>
                                            <li><a href="/PROJECTS/5">All</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a class=" scroll" data-toggle="dropdown" href="#" style="color: white;"><span><i class="fa fa-drop fa-angle-down" aria-hidden="true"></i></span> Publications</a>
                                        <ul class="dropdown-menu hudai">
                                            <li><a href="/PUBLICATIONS/book">Books</a></li>
                                            <li><a href="/PUBLICATIONS/journal">Journal Papers</a></li>
                                            <li><a href="/PUBLICATIONS/conference">Conference Papers</a></li>
                                            <li><a href="/PUBLICATIONS/thesis">Thesis</a></li>
                                            <li><a href="/PUBLICATIONS/other">Others</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a class=" scroll" data-toggle="dropdown" href="#" style="color: white;"><span><i class="fa fa-drop fa-angle-down" aria-hidden="true"></i></span> Supporting Documents</a>
                                        <ul class="dropdown-menu hudai">
                                            <li><a href="/sd/dataset">Dataset</a></li>
                                            <li><a href="/sd/src">Source Code</a></li>
                                            <li><a href="/sd/srs">SRS</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/events" style="color: white;">Events</a></li>
                                    <li><a href="/MEMBERS" style="color: white;">Members</a></li>
                                    <li class="dropdown">
                                        <a class="scroll" data-toggle="dropdown" href="#" style="color: white;"><span><i class="fa fa-drop fa-angle-down" aria-hidden="true"></i></span> {{Auth::user()->name}}</a>
                                        <ul class="dropdown-menu hudai">
                                            <li><a href="/indivisual/profile/{{encrypt(Auth::user()->id)}}">Profile</a></li>
                                                <li><a href="/add/project">Add Project</a></li>
                                                <li><a href="/add/publication">Add Publication</a></li>
                                                <li>
                                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>

                                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endif
                        @else
                         <ul class="nav navbar-nav linka">
                            <li><a href="/" style="color: white;">Home</a></li>
                            <li class="dropdown">
                                <a class=" scroll" data-toggle="dropdown" href="#"><span><i class="fa fa-drop fa-angle-down" aria-hidden="true"></i></span> Projects</a>
                                <ul class="dropdown-menu hudai">
                                    <li><a href="/PROJECTS/1">Funded</a></li>
                                    <li><a href="/PROJECTS/2">Non Funded</a></li>
                                    <li><a href="/PROJECTS/3">Complete</a></li>
                                    <li><a href="/PROJECTS/4">On-going</a></li>
                                    <li><a href="/PROJECTS/5">All</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class=" scroll" data-toggle="dropdown" href="#" style="color: white;"><span><i class="fa fa-drop fa-angle-down" aria-hidden="true"></i></span> Publications</a>
                                <ul class="dropdown-menu hudai">
                                    <li><a href="/PUBLICATIONS/book">Books</a></li>
                                    <li><a href="/PUBLICATIONS/journal">Journal Papers</a></li>
                                    <li><a href="/PUBLICATIONS/conference">Conference Papers</a></li>
                                    <li><a href="/PUBLICATIONS/thesis">Thesis</a></li>
                                    <li><a href="/PUBLICATIONS/other">Others</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class=" scroll" data-toggle="dropdown" href="#" style="color: white;"><span><i class="fa fa-drop fa-angle-down" aria-hidden="true"> Supporting Documents</i></span></a>
                                <ul class="dropdown-menu hudai">
                                    <li><a href="/sd/dataset">Dataset</a></li>
                                    <li><a href="/sd/src">Source Code</a></li>
                                    <li><a href="/sd/srs">SRS</a></li>
                                    <li><a href="/sd/other">Other</a></li>
                                </ul>
                            </li>
                            <li><a href="/events" style="color: white;">Events</a></li>
                            <li><a href="/MEMBERS" style="color: white;">Members</a></li>
                            <li><a href="/login" style="color: white;"></i>Sign In</a></li>
                        </ul>
                         @endif
                    </div><!-- /.navbar-collapse -->

                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End Top Background Image Wrapper -->
