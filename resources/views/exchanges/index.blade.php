@extends('main')
@section('content')
  <div class="column is-12 has-text-centered my-5">
    <a href="{{ route('exchanges.create') }}" class="button is-success is-medium">
      <i class="fas fa-plus"></i>
    </a>
  </div>
@if($exchanges->isNotEmpty())
  <div class="columns is-multiline is-centered is-marginless">
    <div class="column is-5 has-text-centered">
      @foreach ($exchanges as $exchange)
      <div class="box">
        <div class="pt-1 is-size-2">
          {{ $exchange->name }}
        </div>
        <div class="pt-1 is-size-6">
          {{ $exchange->pivot->note }}
        </div>
      </div>
      @endforeach
    </div>
  </div>
@else
  <p class="is-size-5 has-text-centered">
    You must add exchanges to see them. <br /> Start with big plus button.
  </p>
@endif
@endsection