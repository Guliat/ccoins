<nav class="navbar is-fixed-top is-dark nunito" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="{{ url('/') }}">
      <span class="is-size-4 pl-5">Ccoins App</span>
    </a>
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbar-active">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
<div class="navbar-menu" id="navbar-active">
  <div class="navbar-start">
    <span class="navbar-item is-size-5 mt-1">
      @if(Route::current()->getName() == 'trades.active')
        / Trades / Active
      @elseif(Route::current()->getName() == 'trades.closed')
        / Trades / Closed
      @elseif(Route::current()->getName() == 'trades.create')
        / Trades / Adding
      @elseif(Route::current()->getName() == 'coins.index')
        / Coins
      @elseif(Route::current()->getName() == 'coins.create')
        / Coins / Adding
      @elseif(Route::current()->getName() == 'coins.edit')
        / Coins / Editing
      @elseif(Route::current()->getName() == 'exchanges.index' )
        / Exchanges
      @elseif(Route::current()->getName() == 'exchanges.create' )
        / Exchanges / Adding
      @elseif(Route::current()->getName() == 'exchanges.edit' )
        / Exchanges / Editing
      @endif
    </span>
  </div>

  <div class="navbar-end pr-3">
    @if(Auth::check())
    <a href="{{ route('trades.create') }}" class="navbar-item">
      Add Trade
    </a>
    <a href="{{ route('trades.active') }}" class="navbar-item">
      Active Trades
    </a>
    <a href="{{ route('trades.closed') }}" class="navbar-item">
      Closed Trades
    </a>
    <a href="#" class="navbar-item">
      Trades per Exchange
    </a>
    <a href="{{ route('trades.coins') }}" class="navbar-item">
      Trades per Coins
    </a>
    <b class="navbar-item"> | </b>
    <div class="navbar-item">
      <div class="buttons">
    <a class="button is-white is-outlined" href="{{ route('coins.index') }}">Coins</a>
    <a class="button is-white is-outlined" href="{{ route('exchanges.index') }}" >Exchanges</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
      @csrf
      <button type="submit" class="button is-white is-outlined">
        <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
      </button>
    </form>
      </div></div>
    @else
    <div class="navbar-item">
      <div class="buttons">
        <div id="register_login_modal">
          @include('login_modal')
          @include('register_modal')
          <a class="button is-white is-outlined" @click="register_modal = true" >Sign Up</a>
          <a class="button is-white is-outlined px-5" @click="login_modal = true" >
            <span class="icon"><i class="far fa-user"></i></span>
          </a>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
</nav>