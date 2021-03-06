@extends('main')
@section('content')
  <div class="column is-12 has-text-centered my-5">
    <a href="{{ route('manage.exchanges.create') }}" class="button is-success is-medium">
      <i class="fas fa-plus"></i>
    </a>
  </div>
  
  <div class="columns is-multiline is-centered">
    <div class="column is-7 has-text-centered">
      @foreach ($exchanges as $exchange)
      <div class="box @if($exchange->is_active == 0) notification is-danger is-light @endif">
        <div class="columns">
          <div class="column is-10 is-size-4">
            <div class="pt-1">
              {{ $exchange->name }}
            </div>
          </div>            
          <div class="column is-2 has-text-right">
            <div class="dropdown is-hoverable is-right">
              <div class="dropdown-trigger">
                <button class="button" aria-haspopup="true" aria-controls="dropdown">
                  <span class="icon">
                    <i class="fas fa-ellipsis-v" aria-hidden="true"></i>
                  </span>
                </button>
              </div>
              <div class="dropdown-menu has-text-left" id="dropdown" role="menu" style="min-width: 6rem;">
                <div class="dropdown-content">
                  <div class="dropdown-item">
                    <a href='{{ route('manage.exchanges.edit', $exchange->id) }}' class="button is-info is-inverted">
                      <span class="icon"><i class="fas fa-marker"></i></span>
                      <span>EDIT</span>
                    </a>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="column is-12" style="height: 100px;"></div>
  </div>
@endsection