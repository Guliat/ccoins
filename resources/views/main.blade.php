<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('head')
  <body class="has-navbar-fixed-top">
  <div class="container is-fluid">
      @include('toasts')
      @include('navbar')
      @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    @include('scripts')
  </body>
</html>