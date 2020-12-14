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

    <div class="w-full mx-auto">
            {{-- JACK --}}

              <div class="fixed h-full w-full top-0 left-0 z-30 flex items-center justify-center bg-gray-300 @if(!$modalFormVisible) hidden @endif" >
                <div class="bg-white rounded-xl shadow-xl p-10 w-1/2 min-h-1/2 flex flex-col justify-between">
                  <div class="p-4">
                    @if($modal_type == 'sell')
                      <form action="{{ route('trades.sell', $modelId) }}" method="post">
                        @csrf
                        @method('put')
                        <span class="font-bold text-base text-black ">Sell to USD (can sell only a part)</span> <hr />
                        <label class="label">Sell Quantity (if is a part)</label>
                        <input class="border border-gray-500 p-1 bg-gray-100 rounded-lg" type="number" value="{{ $modal_quantity }}" name="quantity" required max="{{ $modal_quantity }}" min="0" step="0.00000001" />
                        <label class="label">Sell Price (if different)</label>
                        <input class="border border-gray-500 p-1 bg-gray-100 rounded-lg" type="number" value="{{ $modal_coin_price }}" name="close_price" placeholder="Sell Price" required step="0.000001" /> <hr />
                        <button type="submit" class="button is-success">Save</button>
                      </form>
                    @elseif($modal_type == 'convert')
                      <form action="{{ route('trades.convert', $modelId) }}" method="post">
                        @csrf
                        @method('put')
                        <span class="font-bold text-base text-black ">Convert to Bitcoin  (can convert only a part)</span> <hr />
                        <label class="label">Quantity (what you converted)</label>
                        <input class="border border-gray-500 p-1 bg-gray-100 rounded-lg" type="number" value="{{ $modal_quantity }}" name="quantity" required step="0.00000001" />
                        <label class="label">Bitcoin Quantity (what you get)</label>
                        <input class="border border-gray-500 p-1 bg-gray-100 rounded-lg" type="number" value="" placeholder="0.12345678" name="bitcoin_quantity" min="0" step="0.00000001" />
                        <label class="label">Bitcoin Price</label>
                        <input class="border border-gray-500 p-1 bg-gray-100 rounded-lg" type="number" value="" name="bitcoin_price" placeholder="$19500" required step="0.000001" /> <hr />
                        <button type="submit" class="button is-success">Save</button>
                      </form>
                    @else
                      <form action="{{ route('trades.update', $modelId) }}" method="post">
                        @csrf
                        @method('put')
                        <span class="font-bold text-base text-black ">Update trade</span> <hr />
                        <label class="label">Quantity</label>
                        <input class="border border-gray-500 p-1 bg-gray-100 rounded-lg" type="number" value="{{ $modal_quantity }}" name="quantity" step="0.00000001" />
                        <label class="label">Open Price</label>
                        <input class="border border-gray-500 p-1 bg-gray-100 rounded-lg" type="number" value="{{ $modal_price }}" name="open_price" step="0.000001" /> <hr />
                        <button type="submit" class="button is-success">Save</button>
                      </form>
                    @endif
                  </div>
                  <div class="p-4">
                    <a class="p-4 rounded-lg shadow-lg bg-red-200 text-white" wire:click="$toggle('modalFormVisible')"> CLOSE </a>
                  </div>
                </div>
              </div>

            {{-- END JACK --}}
      @foreach($data as $trade)
        <div class="p-4 m-5 rounded-xl shadow bg-white flex">
          <div class="flex-none w-1/3 flex items-center">
            <div class="flex flex-col">
              <a class="p-2 mb-1 bg-gray-700 border border-gray-300 rounded-lg text-white text-xs text-center hover:text-green-200" wire:click="updateShowModal({{ $trade->id }})">
                UPDATE
              </a>
              <a class="p-2 mb-1 bg-gray-700 border border-gray-300 rounded-lg text-white text-xs text-center hover:text-green-200" wire:click="sellShowModal({{ $trade->id }})">
                SELL
              </a>
              <a class="p-2 bg-gray-700 border border-gray-300 rounded-lg text-white text-xs text-center hover:text-green-200" wire:click="convertShowModal({{ $trade->id }})">
                CONVERT
              </a>
            </div>
            {{-- <img src="logos/{{ strtolower($trade->coin->symbol) }}-icon-200.png" class="w-10 mx-auto" /> --}}
            <div class="mx-auto text-center text-black text-xs md:text-sm ">
              <div class="uppercase text-blue-500 font-semibold md:text-lg">{{ $trade->coin->symbol }}</div>
              {{ $trade->coin->name }} <br />
              ${{ number_format($trade->coin->price, 4) }}
            </div>	
          </div>
          <div class="flex-auto pl-3">
            <div class="flex">
              <div class="flex-auto">
                <div class="uppercase text-blue-500 font-semibold md:text-lg">{{ $trade->exchange->name }}</div>
                <div class="font-light text-sm text-gray-400">Paid ${{ number_format($trade->paid, 2) }}</div>
                <div class="text-gray-400 text-sm">Available ${{ number_format($trade->available, 2) }}</div>
              </div>
              <div class="flex-auto text-right">
                <div class="text-base font-semibold md:text-xl @if($trade->profit < 0) text-red-400 @else text-green-400 @endif">
                  @if($trade->profit < 0) - @else + @endif
                  ${{ number_format(abs($trade->profit), 2, ',', ' ') }}
                </div>
                <div class="text-xs md:text-lg @if($trade->profit < 0) text-red-400 @else text-green-400 @endif">{{ round(($trade->profit * 100) / $trade->paid, 2) }}%</div>
                <a href="" class="flex justify-end">
                  {{-- <x-heroicon-s-chevron-down class="text-gray-300 h-6 w-6 -mr-1" /> --}}
                </a>
              </div>
            </div>
            <div class="text-left text-gray-600 text-sm">
              Bought {{ number_format($trade->quantity, 6) }} at ${{ number_format($trade->open_price, 4) }}
            </div>
					</div>
        </div>
      
        @endforeach
        </div>
      </div>
      @else
      No records found...
      @endif
		</div>
		{{-- END CONTENT --}}
	</div>
</div>