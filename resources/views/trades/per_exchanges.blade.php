@extends('main')
@section('content')
<div class="columns is-multiline is-centered pt-5">
  @foreach($exchanges as $exchange)
    <div class="column is-7 mx-3">
      <div class="box has-text-left is-size-5">
        <p class="title is-size-3">
          {{ $exchange->name }}
        </p>
        @if($exchange->trades->isNotEmpty())
          <table class="table is-hoverable is-bordered is-fullwidth">
            <tr>
              <th>Coin</th>
              <th>Quantity</th>
              <th>Open Price</th>
              <th>Current Profit</th>
            </tr>
            <?php $total_profit = null; ?>
            @foreach($exchange->trades as $trade)
              <?php 
                $total_profit += (($trade->quantity*$trade->coin->price)-($trade->quantity*$trade->open_price));
                $profit = (($trade->quantity*$trade->coin->price)-($trade->quantity*$trade->open_price))
              ?>
              <tr>
                <td>
                  {{ $trade->coin->name }}
                </td>
                <td>
                  {{ $trade->quantity }}
                </td>
                <td>
                  ${{ $trade->open_price }} 
                </td>
                <td class="@if($profit >= 0) has-text-success @else has-text-danger @endif">
                  <b>${{ number_format($profit, 2) }}</b>
                </td>
              </tr>  
            @endforeach
          </table>
          <div class="has-text-right">
            <span class="tag is-large @if($total_profit >= 0) is-success @else is-danger @endif">
              Total: ${{ number_format($total_profit, 2) }}
            </span>
          </div>
        @else
          <span class="is-size-6">There no active trades in this exchange.</span>
        @endif
      </div>
    </div>
  @endforeach
</div>
@endsection