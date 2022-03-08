<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', ' ') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Favicon -->
    <link type="image/ico" href="{{asset('logo.png')}}" rel="shortcut icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(to top, #34d1a7bf, #34d1a7bf), url(/images/nasa-Q1p7bh3SHj8-unsplash.jpg) no-repeat top center;
            background-size: cover;
            background-color: #34d1a7;
        }
        .card{
            background: linear-gradient(#8ff3da85, #82f7d7ba)!important
        }
    </style>

    @toastr_css
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light shadow-sm"style="border-bottom: 2px solid red;background-image:linear-gradient(#58ffd2, #109c77)!important;">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', '--') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><img src="{{asset('images/users/defaultMaleAvatar.png')}}" alt="" width="22px;">&nbsp;&nbsp;{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
        <div class="col-md-12 m-auto text-center">
            <br>
            <strong class="text-center" style="color: #ffffff;">© 2022 {{env('app_name')}}. All rights reserved. <br>
                Powered by: <a href="https://excellent-soft.net" style="color: #ffffffa8;font-weight: bold;">Excellent-Soft</a>
            </strong>
        </div>
    </main>

    @jquery
    @toastr_js
    @toastr_render
</div>
</body>
</html>
