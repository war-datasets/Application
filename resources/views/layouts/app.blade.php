<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF Token --}}

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    {{-- Collapsed Hamburger --}}
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{ url('/') }}"> {{-- Branding image --}}
                        {{ config('app.name', 'Laravel') }}
                    </a> {{-- /Branding image --}}
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav"> {{-- Left side of the navbar. --}}
                        <li @if (Request::is('casualties*')) class="active" @endif>
                            <a href="{{ route('casualties.index') }}">
                                <span class="fa fa-list" aria-hidden="true"></span> Namenlijst
                            </a>
                        </li>
                        <li @if (Request::is('news*')) class="active" @endif>
                            <a href="{{ route('news.index') }}">
                                <span class="fa fa-newspaper-o" aria-hidden="true"></span> Nieuws
                            </a>
                        </li>
                        <li @if (Request::is('disclaimer*')) class="active" @endif>
                            <a href="{{ route('disclaimer') }}">
                                <span class="fa fa-legal" aria-hidden="true"></span> Disclaimer
                            </a>
                        </li>

                        @if (auth()->check()) {{-- There is a authencated user. --}}
                            <li @if (Request::is('helpdesk*')) class="active" @endif>
                                <a href="{{ route('helpdesk.index') }}">
                                    <span class="fa fa-question" aria-hidden="true"></span> Helpdesk
                                </a>
                            </li>
                        @endif {{-- END authencated user block. --}}
                    </ul>

                    <ul class="nav navbar-nav navbar-right"> {{-- Right side of the navbar --}}
                        @if (Auth::guest()) {{-- Authentication Links --}}
                            <li>
                                <a href="{{ route('login') }}">
                                    <span class="fa fa-sign-in" aria-hidden="true"></span> Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">
                                    <span class="fa fa-plus" aria-hidden="true"></span> Register
                                </a>
                            </li>
                        @else {{-- The user is authencated --}}
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="fa fa-user" aria-hidden="true"></span> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('account.settings') }}"><span class="fa fa-cogs" aria-hidden="true"></span> Account configuratie</a></li>
                                    <li class="divider"></li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="fa fa-sign-out" aria-hidden="true"></span> Afmelden
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
