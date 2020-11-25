<div class="container is-fluid pt-6">
	<div class="columns is-multiline">
		{{-- START SIDEBAR --}}
		<div class="column is-2">
			<div class="has-text-centered is-size-5">
				FILTERS
				<br /><br />
      </div>
      <div class="field">
        <input class="is-checkradio is-danger is-medium" id="all" type="radio" value="0" name="all" wire:model="selected_exchange" checked>
        <label for="all">All</label>
      </div>
			@foreach($user_exchanges as $exchange)
				<div class="field">
					<input class="is-checkradio is-danger is-medium" id="{{ $exchange->name }}" type="radio" value="{{ $exchange->id }}" name="{{ $exchange->name }}" wire:model="selected_exchange">
					<label for="{{ $exchange->name }}">{{ $exchange->name }}</label>
				</div>
			@endforeach
			<br /><br />
			@foreach($user_coins as $coin)
				<div class="field">
					<input class="is-checkradio is-danger" id="{{ $coin->name }}" type="checkbox" value="{{ $coin->id }}" name="{{ $coin->name }}" wire:model="selected_coins">
					<label for="{{ $coin->name }}">
						<b>{{ $coin->symbol }}</b> ({{ $coin->name }})
					</label>
				</div>
			@endforeach 
		</div> 
		{{-- END SIDEBAR --}}
		{{-- START CONTENT --}}
		<div class="column is-10">
			
			<div class="select is-dark mb-3">
				<select wire:model="sort">
          <option>Sort By</option>
          @if($selected_exchange == 0)
            <option value="exchange_name">Exchanges</option>
          @endif
					<option value="coin_name">Coins</option>
					<option value="profit">Profit</option>
				</select>
			</div>
			@if($sort)
				<button class="button is-dark" wire:click="changeDirection">
					@if($direction == 'asc')
						<i class="fa fa-arrow-up"></i>
					@else
						<i class="fa fa-arrow-down"></i>
					@endif
				</button>
      @endif
      <div class="tag is-medium mt-1 @if($total_profit > 0) is-success @else is-danger @endif">
        Profit/Loss: {{ $total_profit }}$
      </div>
      <div class="tag is-medium mt-1 is-warning">
        Total Available: {{ $total_available }}$
      </div>
      @if($selected_coins && count($selected_coins) == 1)
        <div class="tag is-medium mt-1 is-info">
          QUANTITY: {{ $quantity }}
        </div>
        @endif
      @if(!$data->isEmpty())
      <div class="columns is-multiline">
        @foreach($data as $trade)
          <div class="column is-12">
            <div class="box">
              <div class="columns">
                <div class="column is-2">
                  {{ $trade->exchange->name }}  
                </div>
                <div class="column is-2">
                  {{ $trade->coin->name }}
                </div>
                <div class="column is-2">
                  QTY: {{ $trade->quantity }}
                </div>
                <div class="column is-2">
                  OP: {{ $trade->open_price }} / PAID: {{ $trade->paid }}
                </div>
                <div class="column is-2">
                  AVAILABLE: {{ $trade->available }}
                </div>
                <div class="column is-2">
                  P/L <span class="@if($trade->profit > 0) has-text-success @else has-text-danger @endif is-size-5">{{ $trade->profit }}</span>
                </div>

              </div>
            </div>
          </div>
        @endforeach
      </div>
      @else
      No records found...
      <br />
        {{-- @if($filter_exchange_id[0] != 0 && !$filter_coins_ids)
          <span class="has-text-danger is-size-5">Please select at least one coin</span>
        @endif --}}
      @endif
		</div>
		{{-- END CONTENT --}}
	</div>
</div>