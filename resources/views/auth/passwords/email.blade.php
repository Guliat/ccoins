@extends('main')

@section('content')
<div class="content columns is-multiline is-centered">
    <div class="column is-12 py-5"></div>
    <div class="column is-one-third">
        <div class="box">
            <div class="is-size-4">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                @csrf
                    <div class="field">
                        Your email address
                            <p class="control has-icons-left">
                            <input type="email" class="input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </p>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="button is-info">
                        <span class="icon"><i class="far fa-envelope"></i></span>
                        <span>Send Password Reset Link</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
