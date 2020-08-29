@extends('main')
@section('content')
<div class="pt-5"></div>
<div class="content subtitle is-size-6 box" id="close_trade">
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
        <b-modal v-model="modal{{ $trade->id }}" has-modal-card trap-focus :destroy-on-hide="false" aria-role="dialog" aria-modal>
          <div class="modal-card" style="width: 350px">
            <form action="{{ route('trades.delete', $trade->id) }}'" method="post">
            @csrf
            @method('put')
              <header class="modal-card-head">Close trade (can close only a part)</header>
              <section class="modal-card-body">
                  <b-field label="Close Quantity (if is a part)" label-position="on-border">
                      <b-input type="number" :value="{{ $trade->quantity }}" placeholder="Close Quantity" name="quantity" required max="{{ $trade->quantity }}" min="0" step="0.00000001" ></b-input>
                  </b-field>
                  <div class="py-2"></div>
                  <b-field label="Close Price (if different)" label-position="on-border">
                    <b-input type="number" :value="{{ $data[$trade->coin->api_link]['usd'] }}" name="close_price" placeholder="Close Price" required step="0.00000001"></b-input>
                  </b-field>
              </section>
              <footer class="modal-card-foot">
                <button type="submit" class="button is-success">Save</button>
                <a class="button is-danger is-outlined" @click="modal{{ $trade->id }} = false">Cancel</a>
              </footer>
            </form>
          </div>
        </b-modal>
          <button class="button is-danger is-inverted" @click="modal{{ $trade->id }} = true">
            <i class="fas fa-times fa-lg"></i>
          </button>
      </td>
    </tr>
    @endforeach
  </table>
</div> 
@endsection
@section('scripts')
<script>
new Vue({
  el: '#close_trade',
  data: {
    <?php foreach($trades as $trade) { echo 'modal'.$trade->id.': false, '; } ?>
    },
})
</script>
@endsection