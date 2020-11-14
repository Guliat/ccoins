<div class="container is-fluid pt-6">
	<div class="columns is-multiline">
		{{-- START SIDEBAR --}}
		<div class="column is-2">
			<div class="has-text-centered is-size-5">
				FILTERS
				<hr>
			</div>
			<div class="field">
				<input class="is-checkradio is-danger is-medium" id="all" type="radio" value="0" name="all" wire:model="filter_exchange_id" checked>
				<label for="all">All</label>
			</div>
			@foreach($user_exchanges as $exchange)
				<div class="field">
					<input class="is-checkradio is-danger is-medium" id="{{ $exchange->name }}" type="radio" value="{{ $exchange->id }}" name="{{ $exchange->name }}" wire:model="filter_exchange_id">
					<label for="{{ $exchange->name }}">{{ $exchange->name }}</label>
				</div>
			@endforeach
			<hr />
			@if(!empty($filter_coins_ids))
				<a class="has-text-dark" wire:click="deselectAll"><u>Uncheck All</u></a>
			@else
				<a class="has-text-dark" wire:click="selectAll"><u>Check All</u></a>
			@endif

			<br /><br />
			@foreach($user_coins as $coin)
				<div class="field">
					<input class="is-checkradio is-danger" id="{{ $coin->name }}" type="checkbox" value="{{ $coin->id }}" name="{{ $coin->name }}" wire:model="filter_coins_ids">
					<label for="{{ $coin->name }}">
						<b>{{ $coin->symbol }}</b> ({{ $coin->name }})
					</label>
				</div>
			@endforeach
		</div> 
		{{-- END SIDEBAR --}}
		{{-- START CONTENT --}}
		<div class="column is-10">
			
			{{-- <div class="select is-dark mb-3">
				<select wire:model="sort">
					<option>Sort By</option>
					<option value="exchange_id">Exchanges</option>
					<option value="coin_id">Coins</option>
					<option value="profit">Profit</option>
				</select>
			</div> --}}
			{{-- @if($sort)
				<button class="button is-dark" wire:click="change_direction">
					@if($direction == 'asc')
						<i class="fa fa-arrow-up"></i>
					@else
						<i class="fa fa-arrow-down"></i>
					@endif
				</button>
			@endif --}}
					@if(!$data->isEmpty())
					<table class="table is-bordered is-hoverable is-fullwidth">
						<thead>
							<tr>
								<th>Exchange</th>
								<th>Coin</th>
								<th>Quantity</th>
								<th>Open Price</th>
								<th>Paid</th>
								<th>Available</th>
								<th>Profit</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $trade)
							<tr>
								<td>{{ $trade->exchange->name }}</td>
								<td>{{ $trade->coin->name }}</td>
								<td>{{ $trade->quantity }}</td>
								<td>{{ $trade->open_price }}</td>
								<td>{{ $trade->paid }}</td>
								<td>{{ $trade->available }}</td>
								<td>{{ $trade->profit }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@else
					No records found...
					<br />
					@if($filter_exchange_id[0] != 0 && !$filter_coins_ids)
						<span class="has-text-danger is-size-5">Please select at least one coin</span>
					@endif
					@endif
		</div>
		{{-- END CONTENT --}}
	</div>
</div>