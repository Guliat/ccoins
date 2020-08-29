@extends('main')
@section('content')
<div class="pt-5"></div>
<div class="content subtitle is-size-6 box">
  <table class="table is-striped is-hoverable">
    <thead class="is-uppercase is-size-6">
      <th>exchange</th>
      <th>coin</th>
      <th>quantity</th>
      <th>close price</th>
      <th>profit</th>
    </thead>
    @foreach($trades as $trade)
    <tr>
      <td>{{ $trade->exchange->name }}</td>
      <td>{{ $trade->coin->symbol }}</td>
      <td>{{ $trade->quantity }}</td>
      <td>${{ $trade->close_price }}</td>
      <td>${{ number_format(($trade->close_quantity*$trade->close_price) - ($trade->close_quantity*$trade->open_price), 2) }}</td>
    </tr>
    @endforeach
  </table>
</div> 
@endsection