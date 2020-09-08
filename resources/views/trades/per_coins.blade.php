@extends('main')
@section('content')
<div class="columns is-multiline pt-5">
  @foreach ($coins as $coin)
    <div class="column is-one-quarter-fullhd is-one-third-desktop">
      <div class="box has-text-centered is-size-5">
        <a class="button is-info is-outlined has-tooltip-arrow has-tooltip-dark" data-tooltip="{{ $coin->name }}">{{ $coin->symbol }}</a>
        <br /><br />
        <span class="is-size-5">Current Price: ${{ number_format($coin->price,2) }} </span>
        <br />
        @if(!empty($coin->trades))
        <?php $total_quantity = 0; $total_profit = 0; ?>
        @foreach($coin->trades as $trade)
        <?php $total_quantity += $trade->quantity; $total_profit += ($trade->quantity*$trade->coin->price)-($trade->quantity*$trade->open_price); ?>
        @endforeach
        <span class="is-size-5">Quantity: {{ $total_quantity }} </span>
        @endif
        <br />
        <span class="is-size-5">Available: ${{ number_format($total_quantity*$coin->price, 2) }} </span>
        <br />
        <b class="is-size-5 @if($total_profit >=0) has-text-success @else has-text-danger @endif">Profit: ${{ number_format($total_profit, 2) }} </b>
      </div>
    </div>
  @endforeach
</div>
@endsection