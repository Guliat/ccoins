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
              <th>Open Price</th>
              <th>Current P/L</th>
            </tr>
            <?php $total_profit = null; $total_available = null; ?>
            @foreach($exchange->trades as $trade)
              <?php
                $total_available += $trade->quantity*$trade->coin->price;
                $total_profit += (($trade->quantity*$trade->coin->price)-($trade->quantity*$trade->open_price));
                $profit = (($trade->quantity*$trade->coin->price)-($trade->quantity*$trade->open_price))
              ?>
              <tr>
                <td>
                  {{ $trade->quantity }} {{ $trade->coin->symbol }}
                  @if($trade->referal_trade_id)
                   <br />
                    <div class="is-size-7">
                    Converted from {{ $trade->trade->coin->symbol }}
                    </div>
                  @endif
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
            <span class="tag is-large is-light">
              Available: ${{ number_format($total_available, 2) }}
            </span>
            <span class="tag is-large @if($total_profit >= 0) is-success @else is-danger @endif">
              Total P/L: ${{ number_format($total_profit, 2) }}
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