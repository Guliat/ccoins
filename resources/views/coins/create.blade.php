@extends('main')
@section('content')
<form action="{{ route('coins.store') }}" method="post">
    @csrf
    <div class="columns is-multiline">
        <div class="column is-12 mt-5"></div>
        <div class="column is-4"></div>
        <div class="column is-4 box py-5 px-5">
            <div class="field" id="create_coin">
                <div class="control">
                    <b-field label="SELECT COIN" label-position="on-border" type="is-info">
                        <b-autocomplete
                        name="coin"
                        icon-pack="fa"
                        icon="magic"
                        v-model="coin_name"
                        :data="filteredcoinArray"
                        placeholder="autocomplete field"
                        open-on-focus="openOnFocus"
                        clearable="clearable"
                        icon-right="caret-down"
                        @select="option => selected = option">
                        </b-autocomplete>
                      </b-field>
                </div>
            </div>
            <div class="field is-grouped pt-4">
                <div class="control">
                    <button type="submit" class="button is-success ">Add</button>
                </div>
                <div class="control">
                    <a href={{ route('coins.index') }} class="button is-danger is-outlined">Cancel</a>
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
  el: '#create_coin',
  data: {
    coin_name: '',
    selected: null,
    coin: [<?php foreach($coins as $coin) { echo "'$coin->name'".', '; } ?>],
  },
  computed: {
    filteredcoinArray() {
      return this.coin.filter((option) => {
      return option
        .toString()
        .toLowerCase()
        .indexOf(this.coin_name.toLowerCase()) >= 0
      })
    }
  },
});
</script>
@endsection