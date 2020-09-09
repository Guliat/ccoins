<div id="register_modal" class="has-text-dark">
  <b-modal v-model="register_modal" has-modal-card trap-focus :destroy-on-hide="false" aria-role="dialog" aria-modal>
    <div class="modal-card" style="width: auto;min-width: 350px;">
      <form method="POST" action="{{ route('register') }}">
      @csrf
        <header class="modal-card-head is-size-4">New Registration</header>
        <section class="modal-card-body">

          <div class="field">
            Username
            <p class="control has-icons-left">
              <input id="name" type="text" class="input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
            </p>
          </div>
          <div class="field">
            Email
            <p class="control has-icons-left">
              <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required autocomplete="email">
              <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
              </span>
            </p>
          </div>
          <div class="field">
            Password
            <p class="control has-icons-left">
              <input id="password" type="password" class="input" name="password" required autocomplete="new-password">
              <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
              </span>
            </p>
          </div>
          <div class="field">
            Confirm password
            <p class="control has-icons-left">
              <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
              <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
              </span>
            </p>
          </div>

        </section>
        <footer class="modal-card-foot">
        <button type="submit" class="button is-success">Register</button>
        <a class="button is-danger is-outlined" @click="register_modal = false">Cancel</a>
        </footer>
      </form>
    </div>
  </b-modal>
</div>