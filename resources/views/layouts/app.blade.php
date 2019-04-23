<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/checkboxes.js') }}" defer></script>
    <script src="{{ asset('js/jquery.modal.js') }}" defer></script>
    <script src="{{ asset('js/progress-circle.js') }}" defer></script>
    <script src="{{ asset('js/progress-bar.js') }}" defer></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-modal.css') }}" rel="stylesheet">
    <link href="{{ asset('css/progress-circle.css') }}" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div id="app col-sm-12">
    <div id="app">
        @include('inc.navbar')
      <div class="container">
          <div class="flash col-sm-5">
              @if ($message = Session::get('logged'))
                  <div class="alert alert-info">
                      <p>{{ $message }}</p>
                  </div>
              @endif
              @if ($message = Session::get('error'))
                  <div class="alert alert-danger">
                      <p>{{ $message }}</p>
                  </div>
              @endif
              @if ($message = Session::get('checked_error'))
                  <div class="alert alert-info">
                      <p>{{ $message }}</p>
                  </div>
              @endif
          </div>
        @yield('content')
      </div>
    </div>
</body>
</html>
