<?php

namespace App\Http\Livewire\Trades;

use Livewire\Component;
use App\Trades;
use App\Services\TradeService;
use App\Http\Controllers\CoinsController;
use App\Http\Controllers\ExchangesController;

class ActiveTrades extends Component
{

  public $user_exchanges;
  public $selected_exchange = 0;
  public $user_coins;
  public $user_coins_ids = [];
  public $selected_coins = [];
  public $trades_coins_ids;
  public $sort;
  public $direction = 'asc';
  public $quantity;
  public $total_profit = null;


  public function mount()
  {
    $this->user_exchanges = ExchangesController::userActiveExchanges();
    $this->user_coins = CoinsController::userActiveCoins();
  }


  public function getTradesCoinsIds()
  {
    $trades_coins = Trades::active()
              ->when($this->selected_exchange, function ($query) {
                return $query->where('exchange_id', $this->selected_exchange);
              })->get();

    foreach ($trades_coins as $trade) {
      $array[] = $trade->coin_id;
    }
    return array_unique($array);
  }

  public function getTradesCoins()
  {
   return CoinsController::userActiveCoins()->whereIn('id', $this->trades_coins_ids);
  }


  public function calculatedCollection() {
    $calc = new TradeService;
    $newCollection = collect();
    $trades = Trades::active()
              ->when($this->selected_exchange, function ($query) {
                return $query->where('exchange_id', $this->selected_exchange);
              })
              ->when($this->selected_coins, function ($query) {
                return $query->whereIn('coin_id', $this->selected_coins);
              })
              ->get();

    foreach ($trades as $trade) {
      $trade['available'] = $calc->calculateAvailable($trade->quantity, $trade->coin->price);
      $trade['paid'] = $calc->calculatePaid($trade->quantity, $trade->open_price);
      $this->total_profit += $trade['profit'] = (float)$calc->calculateProfit($trade->quantity, $trade->coin->price, $trade->open_price);
      $this->quantity += $trade->quantity;
      $trade['exchange_name'] = $trade->exchange->name;
      $trade['coin_name'] = $trade->coin->name;
      $newCollection->push($trade);
    }
    return $newCollection;
  }

  public function changeDirection()
  {
    if ($this->direction == 'asc') {
      $this->direction = 'desc';
    } else {
      $this->direction = 'asc';
    }
  }
  public function render() {
    $this->quantity = null;
    $this->total_profit = null;
    $this->trades_coins_ids = $this->getTradesCoinsIds();
    $this->user_coins = $this->getTradesCoins();

    if($this->direction == 'asc') {
      $data = $this->calculatedCollection()->sortBy($this->sort);
    }
    else {
      $data = $this->calculatedCollection()->sortByDesc($this->sort);
    }

    return view('livewire.trades.active-trades')->withData($data);
  }

}