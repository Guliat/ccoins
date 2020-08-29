@extends('main')
@section('content')
<div class="columns is-multiline">
  <div class="column is-12 pt-5"></div>
  @foreach($coins as $coin)
   @foreach ($coin->trades as $trade) 
    <div class="column is-one-third">
      <div class="box has-background-dark has-text-centered has-text-light">
        <span class="is-size-3 has-text-weight-light">
          {{ $coin->name }}
        </span>
        <hr class="has-background-light" />
        <?php
          $total_quantity = null;
          $total_paid = null;
            $total_quantity += $trade->quantity;
            $total_paid += ($trade->quantity*$trade->open_price);
          
          ?>
        Current Price ${{ $data[$coin->api_link]['usd'] }} <br />
        Total Quantity {{ $total_quantity }} <br />
        Total Available ${{ number_format($total_quantity*$data[$coin->api_link]['usd'], 2) }} <br />
        Total Paid ${{ number_format($total_paid, 2)}}
        <hr class="has-background-light" />
        Profit / Loss <br />
        <span class="is-size-4">${{ number_format(($total_quantity*$data[$coin->api_link]['usd']) - $total_paid, 2) }}</span>
        <hr class="pt-2 @if(number_format(($total_quantity*$data[$coin->api_link]['usd']) - $total_paid, 0) > 0 ) has-background-success @else has-background-danger @endif" />
      </div>
    </div>
    @endforeach
  @endforeach

</div> 
@endsection