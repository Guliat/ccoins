@extends('main')
@section('content')
<div class="pt-5"></div>
<div class="content subtitle is-size-6">
  <table class="table is-striped is-hoverable">
    <thead class="is-uppercase is-size-6">
      <th>exchange</th>
      <th>coin</th>
      <th>current price</th>
      <th>quantity</th>
      <th>open price</th>
      <th>total paid</th>
      <th>current available</th>
      <th>current profit</th>
    </thead>
    @foreach($trades as $trades)
    <tr>
      <td>{{ $trades->exchange->name }}</td>
      <td>{{ $trades->coin->symbol }}</td>
      <td>
        <?php $data[$trades->link]['usd'] = 10000; ?>
        ${{ $data[$trades->link]['usd'] }}
      </td>
      <td>{{ $trades->quantity }}</td>
      <td>${{ $trades->open_price }}</td>
      <td>${{ number_format($trades->quantity*$trades->open_price, 6) }}</td>
      <td>${{ number_format($data[$trades->link]['usd']*$trades->quantity, 6) }}</td>
      <td>${{ number_format(($trades->quantity*$data[$trades->link]['usd'])-($trades->quantity*$trades->open_price), 6) }}</td>
    </tr>
    @endforeach
  </table>
</div> 
@endsection