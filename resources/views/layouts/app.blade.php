<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="text-transform: capitalize" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Edit profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
        <br>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('discussion.create') }}" class="form-control btn-primary text-center">Create a new Discussion</a>
                    <br>

                    <div class="card card-default">
                        <div class="card-body">
                            <div class="list-group">
                                <li class="list-group-item">
                                    <a href="{{ route('forum') }}" class=" btn-link">Home</a><br>
                                </li>
                                @auth()
                                    <li class="list-group-item">
                                        <a href="/forum?filter=me" class=" btn-link">My discussions</a><br>
                                    </li>
                                @endauth
                                <li class="list-group-item">
                                    <a href="/forum?filter=solved" class=" btn-link">Solved discussions</a>
                                </li><li class="list-group-item">
                                    <a href="/forum?filter=unsolved" class=" btn-link">Unsolved discussions</a>
                                </li>
                            </div>
                        </div>

                        @if(Auth::check())
                            @if(Auth::user()->admin)
                                <div class="card-body">
                                    <div class="list-group">
                                        <li class="list-group-item">
                                            <a href="/channels" class=" btn-link">All Channels</a><br>
                                        </li>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    <br>

                    <div class="card card-default">
                        <div class="card-header">
                            Channels
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($channels as $channel)
                                    <li class="list-group-item">
                                        <a href="{{ route('channel',['slug' => $channel->slug]) }}">{{ $channel->title }}</a>
                                    </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <br>
                </div>

                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script>
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
    </script>
</body>
</html>
