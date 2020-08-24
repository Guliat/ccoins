<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('head')
  <body>
  <div class="container is-fluid">
      @include('toasts')
      @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    @include('scripts')
  </body>
</html>