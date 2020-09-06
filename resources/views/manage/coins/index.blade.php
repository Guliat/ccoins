@extends('main')
@section('content')
<div class="column is-12 has-text-centered my-5">
  <a href="{{ route('manage.coins.create') }}" class="button is-success is-medium">
    <i class="fas fa-plus"></i>
  </a>
</div>
<div class="columns is-multiline">
  @foreach ($coins as $coin)
    <div class="column is-one-quarter-fullhd is-one-third-desktop has-text-centered">
      <div class="box @if($coin->is_active == 0) notification is-danger is-light @endif">
        <div class="columns">
          <div class="column is-3 is-size-5 has-text-centered">
            <a class="icon has-tooltip-arrow has-tooltip-info has-text-info" data-tooltip="{{ $coin->api_link }}" style="text-decoration: none;">
              <i class="fas fa-link"></i>
            </a>
            <br />
            {{ $coin->symbol }}
          </div>
          <div class="column is-7 mt-4 is-size-5 has-text-centered">
            {{ $coin->name }}
          </div>
          <div class="column is-2 has-text-right mt-2">
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
                    <a href='{{ route('manage.coins.edit', $coin->id) }}' class="button is-info is-inverted">
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
    </div>
  @endforeach
</div>
@endsection