<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand" href="#">Laravel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
           
        @if (Auth::user())
            <li class="nav-item">
              <a class="nav-link"  href="{{ url('/home') }}">Home</a>
            </li>
            @endif
        </ul>
        <ul class="navbar-nav ms-auto">
            @if (Auth::guest())
            <li class="nav-item">
              <a class="nav-link"  href="{{ url('/auth/login') }}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/auth/register') }}">Register</a>
            </li>
            @else
            <li class="dropdown nav-item">
              <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                @if (Auth::user()->can_post())
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/new-post') }}">Add post</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/user/'.Auth::id().'/posts') }}">My Posts</a>
                </li>
                @endif
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/user/'.Auth::id()) }}">My Profile</a>
                </li>
                <li class="nav-item">
                  <a  class="nav-link" href="{{ url('/auth/logout') }}">Logout</a>
                </li>
              </ul>
            </li>
            @endif
        </ul>
    </div>
</nav>
        
        <main class="py-4">
            <div class="container">
            @yield('content')
                
            </div>
        </main>
    </div>
</body>
</html>
