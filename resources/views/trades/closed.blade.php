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
        ${{ number_format($trade->profit_loss, 2) }}
        @if($trade->bitcoin_price)
        <br />
        <span class="tag is-danger mt-1">When Coverted !</span>
       @endif
      </td>
    </tr>
    @endforeach
  </table>
</div> 
@endsection