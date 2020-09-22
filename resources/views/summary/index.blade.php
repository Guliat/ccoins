@extends('main')
@section('content')
  <div class="column is-12 has-text-centered my-5">
    <div class="column is-one-quarter">
      <div class="box">
          <span class="title is-size-3">
            TOTAL
          </span>
          <br />
          <span class="subtitle is-size-6">
            (for all coins and exchanges)
          </span>
          <br /><br /><br />
          <span class="heading is-size-6">
            Total P/L for closed trades
          </span>
          <span class="heading is-size-4">
            ${{ number_format($totalClosedPL, 2) }}
          </span>
          <br />
          <span class="heading is-size-6">
            Total P/L for active trades
          </span>
          <small class="is-size-7">(for current coins prices)</small>
          <span class="heading is-size-4">
            ${{ number_format($totalActivePL, 2) }}
          </span>
          <br />
          <span class="heading is-size-6">
            Total Available
          </span>
          <small class="is-size-7">(for current coins prices)</small>
          <span class="heading is-size-4">  
            ${{ number_format($totalAvailable, 2) }}
          </span>
      </div>
    </div>


    {{ $totalCoins }}
    <hr />
    {{ $totalExchanges }}
    <hr />
    {{ $totalTrades }}
    <hr />
    {{ $activeTrades }}
    <hr />
    {{ $closedTrades }}
    <hr />
  </div>
@endsection