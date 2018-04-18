<?php
use App\User as User;
$User  = User::where(['status' => 'Pending'])->get();
$size = sizeof($User);
?>
<nav style="background-color: white; box-shadow: 0px 1px 5px gray;" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a style="color: #00A6C7" class="navbar-brand" href="{{ url('/index') }}">
                {{ config('app.name', 'DSSE') }}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right navstyle">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    @if(Auth::user()->role =='Admin')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
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
                        <li class="dropdown" id="not-menu">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span><i class="fa fa-user-plus"></i><span id="Notification" class="badge red" style="background-color: orangered;"></span></span>
                            </a>
                            <ul class="dropdown-menu col-lg-6" role="menu"  style="width: 400px;text-align: justify; padding: 5px;">
                                @if($size>0)
                                    @foreach($User as $item)
                                        <li class="col-lg-6" style="width: 385px;border-bottom:1px solid grey; ">
                                            {{$item->name}} has requested for a membership
                                            <a href="/admin/userRequest"> View Detail</a>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="col-lg-6" style="width: 385px;border-bottom:1px solid grey; ">No new membership request</li>
                                @endif
                            </ul>
                        </li>

                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav>