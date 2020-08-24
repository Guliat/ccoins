@extends('main')
@section('content')
<div class="column is-12 has-text-centered my-5">
  <a href="{{ route('coins.create') }}" class="button is-success is-medium">
    <i class="fas fa-plus"></i>
  </a>

</div>
<div class="columns is-multiline is-centered">
  <div class="column is-7 has-text-centered">
    @foreach ($coins as $coin)
    <div class="box @if($coin->is_active == 0) notification is-danger is-light @endif">
      
        <div class="columns">


              <div class="column is-2 is-size-4">
                <div class="pt-1">
                  <a class="icon mr-2 has-tooltip-arrow has-tooltip-info has-text-info" data-tooltip="{{ $coin->api_link }}" style="text-decoration: none;">
                    <i class="fas fa-link"></i>
                  </a>
                  {{ $coin->symbol }}
                </div>
              </div>



              <div class="column is-8 is-size-4">
                <div class="pt-1">
                  {{ $coin->name }}
                </div>
              </div>


              
              <div class="column is-2 has-text-right">
                @if($coin->is_active == 1)
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
                        <a href='{{ route('coins.edit', $coin->id) }}' class="button is-info is-inverted">
                          <span class="icon"><i class="fas fa-marker"></i></span>
                          <span>EDIT</span>
                        </a>
                      </div>
                      <div class="dropdown-item">
                        <form action="{{ route('coins.delete', $coin->id) }}'" method="post">
                          @csrf
                          @method('put')
                          <button type="submit" class="button is-danger is-inverted">
                            <span class="icon"><i class="fas fa-trash"></i></span>
                            <span>DELETE</span>
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div> 
                @else
                  <form action="{{ route('coins.undelete', $coin->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button class="button is-danger is-light" title="Return to active">
                      <i class="fas fa-undo"></i>
                    </button>
                  </form>
                @endif
              </div>
            </div>
          </div>
          @endforeach
  </div>
  <div class="column is-12" style="height: 100px;"></div>
</div>
@endsection