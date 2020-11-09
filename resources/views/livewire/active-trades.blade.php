<div class="container pt-6 box">

	{{-- <select wire:model="filter_coin" class="input">
		<option value="">Filter by Coin</option>
		@foreach($filter_coins as $coin)
			<option value="{{ $coin->id }}">{{ $coin->symbol }} ({{ $coin->name }})</option>
		@endforeach
	</select> --}}

		@foreach($user_exchanges as $exchange)
			<input type="checkbox" id="for="{{ $exchange->name }}"" value="{{ $exchange->id }}" wire:model="filter_exchanges">
			<label for="{{ $exchange->name }}">{{ $exchange->name }}</label>
		@endforeach
		
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
</div>