@extends('main')
@section('content')
<form action="{{ route('manage.coins.update', $coin->id) }}" method="post">
  @csrf
  @method('put')
  <div class="columns is-multiline">
      <div class="column is-12 mt-5"></div>
      <div class="column is-4"></div>
      <div class="column is-4 box py-5 px-5">
          <div class="field">
              <label class="label">Symbol <small>(BTC)</small></label>
              <div class="control">
                <input class="input" type="text" placeholder="BTC" value="{{ $coin->symbol }}" name="symbol">
              </div>
          </div>
          <div class="field">
              <label class="label">Full Name <small>(Bitcoin)</small></label>
              <div class="control">
                <input class="input" type="text" placeholder="Bitcoin" value="{{ $coin->name }}" name="name">
              </div>
          </div>  
          <div class="field">
              <label class="label">API Link <small>(bitcoin)</small></label>
              <div class="control">
                  <input class="input" type="text" placeholder="bitcoin" value="{{ $coin->api_link }}" name="api_link">
              </div>
          </div> 
          <div class="field is-grouped pt-4">
              <div class="control">
                  <button type="submit" class="button is-success ">
                    <span class="icon">
                        <i class="fas fa-sync"></i>
                    </span>
                    <span>Update</span>
                  </button>
              </div>
              <div class="control">
                  <a href={{ route('manage.coins.index') }} class="button is-dark is-outlined">Cancel</a>
              </div>
          </div>
      </div>
      <div class="column is-4"></div>
  </div>
</form>
@endsection