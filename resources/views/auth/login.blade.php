@extends('main')
@section('content')
<form method="POST" action="{{ route('login') }}">
@csrf
  <div class="columns is-centered is-multiline">
    <div class="column is-12 mt-5 has-text-centered"></div>
    <div class="column is-4 box px-6 pb-6">
      <p class="heading is-size-2 has-text-centered pb-5">Login</p>
      <div class="field">
        <label for="email" class="label">E-mail</label>
        <input id="email" placeholder="email" type="email" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="has-text-danger" role="alert">
          {{ $message }}
        </span>
        @enderror
      </div>
      <div class="field">
        <label for="password" class="label">Password</label>
        <input id="password" placeholder="password" type="password" class="input" name="password" required autocomplete="current-password">
      </div>
      <div class="field">
        <label class="checkbox">
          <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
        </label>
      </div>
      <button type="submit" class="button is-success">Login</button>
      @if (Route::has('password.request'))
        <br /><br />
        <a class="is-text" href="{{ route('password.request') }}">
          Forgot Your Password?
        </a>
      @endif
    </div>
  </div>
</form>
@endsection
