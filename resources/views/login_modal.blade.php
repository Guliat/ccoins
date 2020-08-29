<div id="login_modal">
  <b-modal v-model="login_modal" has-modal-card trap-focus :destroy-on-hide="false" aria-role="dialog" aria-modal>
  <div class="modal-card" style="width: 350px">
    <form action="{{ route('login') }}" method="post">
    @csrf 
      <header class="modal-card-head has-text-dark is-size-4">Login</header>
      <section class="modal-card-body">
          @csrf
          <div class="field">
            Email
            <p class="control has-icons-left">
              <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
              </span>
            </p>
          </div>
          <div class="field">
            Password
            <p class="control has-icons-left">
              <input id="password" type="password" class="input" name="password" required autocomplete="current-password">
              <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
              </span>
            </p>
          </div>
            <input class="checkbox mt-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="has-text-dark" for="remember">Remember Me</label>
            <hr />
            @if (Route::has('password.request'))
              <a class="has-text-info" href="{{ route('password.request') }}">Forgot Your Password?</a>
            @endif
      </section>
      <footer class="modal-card-foot">
      <button type="submit" class="button is-success">Login</button>
      <a class="button is-danger is-outlined" @click="login_modal = false">Cancel</a>
      </footer>
    </form>
  </div>
</b-modal>
</div>