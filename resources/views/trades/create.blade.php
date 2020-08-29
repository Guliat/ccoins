@extends('main')
@section('content')
<form action="{{ route('trades.store') }}" method="post">
    @csrf
    <div class="columns is-multiline">
        <div class="column is-12 mt-5"></div>
        <div class="column is-4"></div>
        <div class="column is-4 box py-5 px-5" id="create_trade">

          <b-field label="EXCHANGE" label-position="on-border" type="is-info">
            <b-autocomplete
            name="exchange"
            icon-pack="fa"
            icon="magic"
            v-model="exchange_name"
            :data="filteredExchangeArray"
            placeholder="...start writing"
            open-on-focus="openOnFocus"
            clearable="clearable"
            icon-right="caret-down"
            @select="option => selected = option">
            </b-autocomplete>
          </b-field>

          <div class="py-3"></div>
          
          <b-field label="COIN" label-position="on-border" type="is-info">
            <b-autocomplete
            name="coin"
            icon-pack="fa"
            icon="magic"
            v-model="coin_name"
            :data="filteredCoinArray"
            placeholder="...start writing"
            open-on-focus="openOnFocus"
            clearable="clearable"
            icon-right="caret-down"
            @select="option => selected = option">
            </b-autocomplete>
          </b-field>

          <div class="py-3"></div>

          <b-field label="QUANTITY" label-position="on-border" type="is-info">
            <b-input placeholder="1000" name="quantity"></b-input>
          </b-field>

          <div class="py-3"></div>
  
          <b-field label="OPEN PRICE" label-position="on-border">
            <b-input placeholder="$0.039" name="open_price"></b-input>
          </b-field>

            <div class="field is-grouped pt-4">
                <div class="control">
                    <button type="submit" class="button is-success ">Create</button>
                </div>
                <div class="control">
                    <a href={{ route('trades.active') }} class="button is-danger is-outlined">Cancel</a>
                </div>
            </div>
        </div>
        <div class="column is-4"></div>
    </div>
</form>
@endsection
@section('scripts')
<script>
new Vue({
  el: '#create_trade',
  data: {
    coin_name: '',
    exchange_name: '',
    selected: null,
    coin: [<?php foreach($coins as $coin) { echo "'$coin->name - $coin->symbol'".', '; } ?>],
    exchange: [<?php foreach($exchanges as $exchange) { echo "'$exchange->name'".', '; } ?>],
  },
  computed: {
    filteredCoinArray() {
      return this.coin.filter((option) => {
      return option
        .toString()
        .toLowerCase()
        .indexOf(this.coin_name.toLowerCase()) >= 0
      })
    },
    filteredExchangeArray() {
      return this.exchange.filter((option) => {
      return option
        .toString()
        .toLowerCase()
        .indexOf(this.exchange_name.toLowerCase()) >= 0
      })
    }
  },
});
</script>
@endsection