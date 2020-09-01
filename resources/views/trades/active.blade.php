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
      <td>
        {{ $trade->quantity }}
        <br />
        <span class="tag is-warning">
          From {{ $trade->trade->close_quantity }} {{ $trade->trade->coin->symbol }}
        </span>
      </td>
      <td>${{ $trade->open_price }}</td>
      <td>{{ $trade->open_at }}</td>
      <td>${{ number_format($trade->quantity*$trade->open_price, 6) }}</td>
      <td>${{ number_format($data[$trade->coin->api_link]['usd']*$trade->quantity, 6) }}</td>
      <td>${{ number_format(($trade->quantity*$data[$trade->coin->api_link]['usd'])-($trade->quantity*$trade->open_price), 6) }}</td>
      <td>
        <div class="buttons has-addons">
          <b-modal v-model="sell_modal{{ $trade->id }}" has-modal-card trap-focus :destroy-on-hide="false" aria-role="dialog" aria-modal>
            <div class="modal-card" style="width: 350px">
              <form action="{{ route('trades.sell', $trade->id) }}" method="post">
              @csrf
              @method('put')
                <header class="modal-card-head">Sell to USD (can sell only a part)</header>
                <section class="modal-card-body">
                    <b-field label="Sell Quantity (if is a part)" label-position="on-border">
                        <b-input type="number" :value="{{ $trade->quantity }}" placeholder="Sell Quantity" name="quantity" required max="{{ $trade->quantity }}" min="0" step="0.00000001" ></b-input>
                    </b-field>
                    <div class="py-2"></div>
                    <b-field label="Sell Price (if different)" label-position="on-border">
                      <b-input type="number" :value="{{ $data[$trade->coin->api_link]['usd'] }}" name="close_price" placeholder="Sell Price" required step="0.00000001"></b-input>
                    </b-field>
                </section>
                <footer class="modal-card-foot">
                  <button type="submit" class="button is-success">Save</button>
                  <a class="button is-danger is-outlined" @click="sell_modal{{ $trade->id }} = false">Cancel</a>
                </footer>
              </form>
            </div>
          </b-modal>
          <button class="button is-small is-info is-outlined has-tooltip-arrow has-tooltip-dark" data-tooltip="Sell to USD" @click="sell_modal{{ $trade->id }} = true">
            Sell
          </button>
          <b-modal v-model="convert_modal{{ $trade->id }}" has-modal-card trap-focus :destroy-on-hide="false" aria-role="dialog" aria-modal>
            <div class="modal-card" style="width: 350px">
              <form action="{{ route('trades.convert', $trade->id) }}" method="post">
              @csrf
              @method('put')
                <header class="modal-card-head">Convert to Bitcoin  (can convert only a part)</header>
                <section class="modal-card-body">
                  <b-field label="Quantity (what you converted)" label-position="on-border">
                    <b-input type="number" :value="{{ $trade->quantity }}" name="quantity" placeholder="Converted Quantity" required step="0.00000001"></b-input>
                  </b-field>
                  <div class="py-2"></div>
                  <b-field label="Bitcoin Quantity (what you get)" label-position="on-border">
                    <b-input type="number" value="" placeholder="0.12345678" name="bitcoin_quantity" required max="{{ $trade->quantity }}" min="0" step="0.00000001" ></b-input>
                  </b-field>
                  <div class="py-2"></div>
                  <b-field label="Bitcoin Price (if different)" label-position="on-border">
                    <b-input type="number" :value="{{ $data['bitcoin']['usd'] }}" name="bitcoin_price" placeholder="Bitcoin Price" required step="0.00000001"></b-input>
                  </b-field>
                </section>
                <footer class="modal-card-foot">
                  <button type="submit" class="button is-success">Save</button>
                  <a class="button is-danger is-outlined" @click="convert_modal{{ $trade->id }} = false">Cancel</a>
                </footer>
              </form>
            </div>
          </b-modal>
          <button @if($trade->coin_id == 1) disabled @endif class="button is-small is-success is-outlined has-tooltip-arrow has-tooltip-dark" data-tooltip="Convert to Bitcoin" @click="convert_modal{{ $trade->id }} = true">
              Convert
          </button>
        </div>
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
    <?php foreach($trades as $trade) { echo 'sell_modal'.$trade->id.': false, '; echo 'convert_modal'.$trade->id.': false, '; } ?>
    },
})
</script>
@endsection