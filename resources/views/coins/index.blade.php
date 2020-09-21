@extends('main')
@section('content')
  <div class="column is-12 has-text-centered my-5">
    <a href="{{ route('coins.create') }}" class="button is-success is-medium">
      <i class="fas fa-plus"></i>
    </a>
  </div>
@if($coins->isNotEmpty())
  <div class="columns is-marginless is-multiline">
    @foreach ($coins as $coin)
      <div class="column is-one-quarter-fullhd is-one-third-desktop has-text-centered">
        <div class="box has-text-centered">
          <div class="pt-1 is-size-3">
            {{ $coin->name }}
          </div>
          <div class="pt-1">
            <span class="tag is-dark is-medium">{{ $coin->symbol }}</span>
          </div>
          <div class="pt-1 is-size-6">
            {{ $coin->pivot->note }}
          </div>
        </div>
      </div>
    @endforeach
  </div>
@else
  <p class="is-size-5 has-text-centered">
    You must add coins to see them. <br /> Start with big plus button.
  </p>
@endif
@endsection