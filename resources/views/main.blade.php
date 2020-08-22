<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('head')
  <body>
    <div class="container is-fluid">
      @yield('content')
    </div>
  </body>
</html>