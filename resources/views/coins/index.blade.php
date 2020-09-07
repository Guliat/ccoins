@extends('main')
@section('content')
  <div class="column is-12 has-text-centered my-5">
    <a href="{{ route('coins.create') }}" class="button is-success is-medium">
      <i class="fas fa-plus"></i>
    </a>
  </div>
@if($coins->isNotEmpty())
  <div class="columns is-multiline">
    @foreach ($coins as $coin)
      <div class="column is-one-quarter-fullhd is-one-third-desktop has-text-centered">
        <div class="box has-text-centered is-size-4">
          @if(!empty($coin->trades))
          <?php $total_quantity = null; ?>
          @foreach($coin->trades as $trade)
          <?php $total_quantity += $trade->quantity; ?>
          @endforeach
          Available Quantity
          <br />
          {{ $total_quantity }}
          @endif
          <br />  
          {{ $coin->name }}
          <br />
          <span class="tag is-dark">{{ $coin->symbol }}</span>
          <br />
          Current Price
          <br />
          ${{ $coin->price }}
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