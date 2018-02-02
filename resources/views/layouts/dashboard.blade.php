<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112263700-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-112263700-1');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{-- {{ config('app.name', 'UppFeed') }} --}}
                        Upp<span>Feed</span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    {{-- <ul class="nav navbar-nav">
                        &nbsp;
                    </ul> --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if(Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            @if(Auth::user()->role == 'designer')
                                <li class="not-on-desktop">
                                    <a href="{{ route('management.project') }}">Project Management</a>
                                </li>
                                <li class="not-on-desktop">
                                    <a href="{{ route('show.profile', auth()->user()->profile->profile_slug) }}">My Profile</a>
                                </li>
                            @else
                                <li class="not-on-desktop">
                                    <a href="{{ route('index.project') }}">
                                        <i class="fa fa-cogs" aria-hidden="true"></i> Your App Design
                                    </a>
                                </li>
                                <li class="not-on-desktop">
                                    <a href="{{ route('index.businessinfo') }}">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> Business Information
                                    </a>
                                </li>
                                <li class="not-on-desktop">
                                    <a href="{{ route('index.times') }}">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i> Opening Times
                                    </a>
                                </li>
                                <li class="not-on-desktop">
                                    <a href="{{ route('index.menu') }}">
                                        <i class="fa fa-cutlery" aria-hidden="true"></i> Food & Drink Menus
                                    </a>
                                </li>
                                <li class="not-on-desktop">
                                    <a href="{{ route('index.gallery') }}">
                                        <i class="fa fa-camera" aria-hidden="true"></i> Image Galleries
                                    </a>
                                </li>
                                <li class="not-on-desktop">
                                    <a href="{{ route('index.deals') }}">
                                        <i class="fa fa-ticket" aria-hidden="true"></i> Special Offers
                                    </a>
                                </li>
                                <li class="not-on-desktop">
                                    <a href="{{ route('index.events') }}">
                                        <i class="fa fa-calendar" aria-hidden="true"></i> Upcoming Events
                                    </a>
                                </li>
                                <li class="not-on-desktop">
                                    <a href="{{ route('index.notifications') }}">
                                        <i class="fa fa-bell-o" aria-hidden="true"></i> Push Notifications
                                    </a>
                                </li>
                                <li class="not-on-desktop">
                                    <a href="{{ route('index.reservations') }}">
                                        <i class="fa fa-users" aria-hidden="true"></i> Reservation Enquiries
                                    </a>
                                </li>
                                <li class="not-on-desktop">
                                    <a href="{{ route('index.reviews') }}">
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i> Customer Reviews
                                    </a>
                                </li>
                                <li class="not-on-desktop">
                                    <a href="{{ route('index.customers') }}">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i> Subscribers
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i style="width:30px;" class="fa fa-sign-out not-on-desktop" aria-hidden="true"></i> Log Out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            {{-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li> --}}
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @if(session()->has('notification'))
            <div class="notification">
                <i style="margin-right:3px;" class="fa fa-check-circle-o" aria-hidden="true"></i> {{ session()->get('notification') }}
            </div>
        @endif

        <div class="row no-mr">
            <div class="col-sm-4 col-md-3 no-pr">
                @include('partials.sidemenu')
            </div>
            <div class="col-sm-8 col-md-9 no-pl no-pr content-scroll">
                @yield('content')
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
