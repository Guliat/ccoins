@extends('main')
@section('content')
<form action="{{ route('exchanges.update', $exchange->id) }}" method="post">
  @csrf
  @method('put')
  <div class="columns is-multiline">
      <div class="column is-12 mt-5"></div>
      <div class="column is-4"></div>
      <div class="column is-4 box py-5 px-5">
          <div class="field">
              <label class="label">Exchange Name <small>(Coinbase)</small></label>
              <div class="control">
                <input class="input" type="text" placeholder="Coinbase" value="{{ $exchange->name }}" name="name">
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
                  <a href={{ route('exchanges.index') }} class="button is-dark is-outlined">Cancel</a>
              </div>
          </div>
      </div>
      <div class="column is-4"></div>
  </div>
</form>
@endsection