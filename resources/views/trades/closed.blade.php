@extends('main')
@section('content')
<div class="pt-5"></div>
<div class="content subtitle is-size-6 box">
  <table class="table is-striped is-hoverable">
    <thead class="is-uppercase is-size-6">
      <th>exchange</th>
      <th>coin</th>
      <th>closed quantity</th>
      <th>price</th>
      <th>profit</th>
    </thead>
    @foreach($trades as $trade)
    <tr>
      <td>{{ $trade->exchange->name }}</td>
      <td>{{ $trade->coin->symbol }}</td>
      <td>
        <span class="is-size-5">{{ $trade->close_quantity }}</span>
        @if($trade->bitcoin_quantity)
          <br /><span class="tag is-warning mt-1">Converted to {{ $trade->bitcoin_quantity }} BTC</span>
        @endif
      </td>
      <td>
        @if($trade->close_price)
          ${{ $trade->close_price }}
        @else
          ${{ $trade->bitcoin_price }}
        @endif
      </td>
      <td>
        @if($trade->bitcoin_price)
          <span class="is-size-5">${{ number_format($trade->bitcoin_quantity*$trade->bitcoin_price, 2) }}</span>
          <br /><span class="tag is-danger mt-1">When Coverted !</span>
        @else
          ${{ number_format(($trade->close_quantity*$trade->close_price) - ($trade->close_quantity*$trade->open_price), 2) }}
        @endif
      </td>
    </tr>
    @endforeach
  </table>
</div> 
@endsection