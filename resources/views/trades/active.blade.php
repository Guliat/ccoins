@extends('main')
@section('content')
<div class="pt-5"></div>
<div class="content subtitle is-size-6 box">
  <table class="table is-hoverable">
    <thead class="is-uppercase is-size-6">
      <th>exchange</th>
      <th>coin</th>
      <th>current price</th>
      <th>quantity</th>
      <th>open price</th>
      <th>open at</th>
      <th>total paid</th>
      <th>current available</th>
      <th>current profit</th>
      <th></th>
    </thead>
    @foreach($trades as $trade)
    <tr>
      <td>{{ $trade->exchange->name }}</td>
      <td>{{ $trade->coin->symbol }}</td>
      <td>
        ${{ $data[$trade->coin->api_link]['usd'] }}
      </td>
      <td>{{ $trade->quantity }}</td>
      <td>${{ $trade->open_price }}</td>
      <td>{{ $trade->open_at }}</td>
      <td>${{ number_format($trade->quantity*$trade->open_price, 6) }}</td>
      <td>${{ number_format($data[$trade->coin->api_link]['usd']*$trade->quantity, 6) }}</td>
      <td>${{ number_format(($trade->quantity*$data[$trade->coin->api_link]['usd'])-($trade->quantity*$trade->open_price), 6) }}</td>
      <td>
        <form action="{{ route('trades.delete', $trade->id) }}'" method="post">
          @csrf
          @method('put')
          <button type="submit" class="button is-danger is-inverted">
            <i class="fas fa-times"></i>
          </button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div> 
@endsection