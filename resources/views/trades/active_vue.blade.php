@extends('main')
@section('content')
<div class="pt-5"></div>
<div class="content subtitle is-size-6 box" id="close_trade">
  <table class="table is-hoverable">
    <thead class="is-uppercase">
      <th></th>
      <th>exchange</th>
      <th>coin</th>
      <th>current price</th>
      <th>quantity</th>
      <th>open price</th>
      <th>open at</th>
      <th>total paid</th>
      <th>current available</th>
      <th>current profit/loss</th>
      <th></th>
    </thead>
    @foreach($trades as $trade)
    <?php $profit = (($trade->quantity*$trade->coin->price)-($trade->quantity*$trade->open_price)); ?>
    <tr>
      <td>
        <b-modal v-model="edit_modal{{ $trade->id }}" has-modal-card trap-focus :destroy-on-hide="false" aria-role="dialog" aria-modal>
          <div class="modal-card" style="width: 350px">
            <form action="{{ route('trades.update', $trade->id) }}" method="post">
            @csrf
            @method('put')
              <header class="modal-card-head">Edit trade</header>
              <section class="modal-card-body">
                  <b-field label="Quantity" label-position="on-border">
                      <b-input type="number" :value="{{ $trade->quantity }}" name="quantity" required step="0.00000001" ></b-input>
                  </b-field>
                  <div class="py-2"></div>
                  <b-field label="Open Price" label-position="on-border">
                    <b-input type="number" :value="{{ $trade->open_price }}" name="open_price" required step="0.000001"></b-input>
                  </b-field>
              </section>
              <footer class="modal-card-foot">
                <button type="submit" class="button is-success">Save</button>
                <a class="button is-danger is-outlined" @click="edit_modal{{ $trade->id }} = false">Cancel</a>
              </footer>
            </form>
          </div>
        </b-modal>
        <button class="button is-primary is-outlined is-small has-tooltip-arrow has-tooltip-dark" data-tooltip="Edit this trade" @click="edit_modal{{ $trade->id }} = true">
          EDIT
        </button>
      </td>
      <td>{{ $trade->exchange->name }}</td>
      <td>{{ $trade->coin->symbol }}</td>
      <td>
        ${{ $trade->coin->price }}
      </td>
      <td>
        {{ $trade->quantity }}
        <br />
        @if($trade->referal_trade_id)
          <span class="tag is-warning">
            From {{ $trade->trade->close_quantity }} {{ $trade->trade->coin->symbol }}
          </span>
        @endif
      </td>
      <td>${{ $trade->open_price }}</td>
      <td>{{ $trade->open_at }}</td>
      <td>${{ number_format($trade->quantity*$trade->open_price, 6) }}</td>
      <td>${{ number_format($trade->coin->price*$trade->quantity, 6) }}</td>
      <td>
        <b class="@if($profit >= 0) has-text-success @else has-text-danger @endif">${{ number_format($profit, 2) }}</b>
      </td>
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
                      <b-input type="number" :value="{{ $trade->coin->price }}" name="close_price" placeholder="Sell Price" required step="0.000001"></b-input>
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
                    <b-input type="number" :value="{{ $bitcoin }}" name="bitcoin_price" placeholder="Bitcoin Price" required step="0.000001"></b-input>
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
    <?php foreach($trades as $trade) { echo 'edit_modal'.$trade->id.': false, '; echo 'sell_modal'.$trade->id.': false, '; echo 'convert_modal'.$trade->id.': false, '; } ?>
    },
})
</script>
@endsection