<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Backend</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div id="layout-wraper">
        <div id="menu-wrapper">
            <div class="logo">
                <img src="{{ asset('images/logo.jpg') }}"/>
            </div>
            <ul>
                <li>
                    <dl>
                        <dt><span class="iconfont icon-dashboard" /></dt>
                        <dd>Dashboard</dd>
                    </dl>

                </li>
                <li>
                    <dl>
                        <dt><span class="iconfont icon-catalog" /></dt>
                        <dd>Catalog</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><span class="iconfont icon-customer" /></dt>
                        <dd>Customer</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><span class="iconfont icon-content" /></dt>
                        <dd>Cms

                            <div class="menu-children">
                                <ul>
                                    <li>Item1</li>
                                    <li>Item2</li>
                                    <li>Item3</li>
                                </ul>
                            </div>
                        </dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><span class="iconfont icon-system" /></dt>
                        <dd>System</dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div id="page-wrapper">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ adminUrl('logout') }}"
                                       onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ adminUrl('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

</div>
</body>
</html>
