<div class="container is-fluid pt-6">
	<div class="columns">
		{{-- START SIDEBAR --}}
		<div class="column is-2">
			<div class="has-text-centered is-size-5">
				FILTERS
				<hr>
			</div>
			<div class="field">
				<input class="is-checkradio is-danger is-medium" id="all" type="radio" value="0" name="all" wire:model="filter_exchanges" checked>
				<label for="all">All</label>
			</div>
			@foreach($user_exchanges as $exchange)
				<div class="field">
					<input class="is-checkradio is-danger is-medium" id="{{ $exchange->name }}" type="radio" value="{{ $exchange->id }}" name="{{ $exchange->name }}" wire:model="filter_exchanges">
					<label for="{{ $exchange->name }}">{{ $exchange->name }}</label>
				</div>
			@endforeach
			<hr />	
			@foreach($user_coins as $coin)
				<div class="field">
					<input class="is-checkradio is-danger" id="{{ $coin->name }}" type="checkbox" value="{{ $coin->id }}" name="{{ $coin->name }}" wire:model="filter_coins">
					<label for="{{ $coin->name }}">
						<b>{{ $coin->symbol }}</b> ({{ $coin->name }})
					</label>
				</div>
			@endforeach
		</div> 
		{{-- END SIDEBAR --}}
		{{-- START CONTENT --}}
		<div class="column is-10">
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
					@if($filter_exchanges[0] != 0 && !$filter_coins)
						<span class="has-text-danger is-size-5">Please select at least one coin</span>
					@endif
					@endif
		</div>
		{{-- END CONTENT --}}
	</div>
</div>