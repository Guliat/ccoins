@extends('main')
@section('content')
<form method="POST" action="{{ route('register') }}">
@csrf
  <div class="columns is-centered is-multiline">
    <div class="column is-12 mt-5 has-text-centered"></div>
    <div class="column is-4 box px-6 pb-6">
      <p class="heading is-size-3 has-text-centered pb-3">New registration</p>
      <div class="field">
        <label for="name" class="label">Username</label>
        <input id="name" type="text" class="input @error('name') is-danger @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
          <span class="has-text-danger" role="alert">
            {{ $message }}
          </span>
        @enderror
      </div>
      <div class="field">
        <label for="email" class="label">E-mail</label>
        <input id="email" type="email" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
        <span class="has-text-danger" role="alert">
          {{ $message }}
        </span>
        @enderror
      </div>
      <div class="field">
        <label for="password" class="label">Password</label>
        <input id="password" type="password" class="input @error('password') is-danger @enderror" name="password" required autocomplete="new-password">
        @error('password')
          <span class="has-text-danger" role="alert">
            {{ $message }}
          </span>
        @enderror
      </div>
      <div class="field">
        <label for="password-confirm" class="label">Confirm Password</label>
        <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
        @error('password')
          <span class="has-text-danger" role="alert">
            {{ $message }}
          </span>
        @enderror
      </div>
      <button type="submit" class="button is-success is-fullwidth mt-5">Register Me</button>
    </div>
  </div>
</form>
@endsection