@extends('main')
@section('content')
<div class="columns is-multiline is-centered pt-5">
  @foreach($exchanges as $exchange)
    <div class="column is-6 mx-3">
      <div class="box has-text-left is-size-5">
        <p class="title is-size-3">
          {{ $exchange->name }}
        </p>
        @if($exchange->trades->isNotEmpty())
          <table class="table is-hoverable is-bordered">
            <tr>
              <th>Coin</th>
              <th>Quantity</th>
              <th>Open Price</th>
              <th>Current Profit</th>
            </tr>
            @foreach($exchange->trades as $trade)
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
                <td>
                  ${{ number_format(($trade->quantity*$trade->coin->price)-($trade->quantity*$trade->open_price), 2) }}
                </td>
              </tr>  
            @endforeach
          </table>
        @else
          <span class="is-size-6">There no active trades in this exchange.</span>
        @endif
      </div>
    </div>
  @endforeach
</div>
@endsection