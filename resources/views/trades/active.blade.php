@extends('main')
@section('content')


<?php #foreach($trades as $trade ) { $profit = (($trade->quantity*$trade->coin->price)-($trade->quantity*$trade->open_price)); } ?>
<div class="pt-5"></div>
<div class="content subtitle is-size-6 box" id="active_trades">

        <b-table
            :data="data"
            icon-pack="fa"
            paginated
            per-page="15"
            pagination-simple
            sort-icon="arrow-up"
            striped
            default-sort="profit"
            default-sort-direction="desc"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page"
            detailed
            detail-key="id"
            >  
            <b-table-column field="exchange_name" label="Exchange" sortable v-slot="props">
              @{{ props.row.exchange }}
            </b-table-column>

            <b-table-column field="coin_symbol" label="Coin" sortable v-slot="props">
              @{{ props.row.coin }}
            </b-table-column>

            <b-table-column field="quantity" label="Quantity" sortable v-slot="props">
              @{{ props.row.quantity }}
            </b-table-column>

            <b-table-column field="available" label="Available (current price)" sortable v-slot="props">
              $ @{{ props.row.available }}
            </b-table-column>

            <b-table-column field="profit" label="Profit" sortable v-slot="props">              
              <span :class="['is-size-5', {'has-text-danger': props.row.profit < 0}, {'has-text-success': props.row.profit > 0}]">
               $ @{{ props.row.profit }}
              </span>
            </b-table-column>

            <template slot="detail" slot-scope="props">
              <a class="button is-primary has-tooltip-arrow has-tooltip-dark" data-tooltip="Edit this trade" v-bind:href="'/close/'+props.row.coin+''">
                Edit
              </a>  
              <a class="button is-info has-tooltip-arrow has-tooltip-dark" data-tooltip="Sell this coins" v-bind:href="'/close/'+props.row.coin+''">
                Sell
              </a>
              <a class="button is-warning has-tooltip-arrow has-tooltip-dark" data-tooltip="Convert to BTC" v-bind:href="'/close/'+props.row.coin+''">
                Convert
              </a>
            </template>


        </b-table>

</div> 
@endsection
@section('scripts')
<script>
new Vue({
  el: '#active_trades',
  data: {
    data: <?php echo "[".$trades."],"; ?>
  }
})
</script>
@endsection