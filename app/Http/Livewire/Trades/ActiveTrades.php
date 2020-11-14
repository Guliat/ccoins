<?php

namespace App\Http\Livewire\Trades;

use App\User;
use App\Trades;
use Livewire\Component;
use App\Http\Controllers\TradesController;

class ActiveTrades extends Component {

  public $user_exchanges;
  public $user_coins;
  public $user_coins_ids = [];
  public $exchanges_coins = [];
  public $filter_exchange_id = [0];
  public $filter_coins_ids = [];
  public $trades_coins_ids = [];
  // public $sort = '';
  // public $direction = 'asc';

  public function mount() {

    $user = User::where('id', auth()->id())->first();
    $trades = Trades::with('coin')->get();

    foreach($trades as $trade) {
      $array[] = $trade->coin->id;
      $this->user_coins_ids = array_unique($array);
    }

    if(empty($this->user_coins))
    {
      $this->user_coins = $user->coins->whereIn('id', $this->user_coins_ids);
    }

    if(empty($this->user_exchanges))
    {
      $this->user_exchanges = $user->exchanges;
    }

  }

  // public function change_direction()
  // {
  //   if($this->direction == 'asc') {
  //     $this->direction = 'desc';
  //   } else {
  //     $this->direction = 'asc';
  //   }
  // }

  public function selectAll() {
    $this->filter_coins_ids = $this->user_coins_ids;
  }
  public function deselectAll()
  {
    $this->filter_coins_ids = [];
  }

  public function render() {
    $trades = new TradesController;
    if ($this->filter_exchange_id[0] == 0 && empty($this->filter_coins_ids))
    {
      // RETURN ALL RECORDS
      $data = $trades->activeTrades();
    }
    elseif ($this->filter_exchange_id[0] == 0 && !empty($this->filter_coins_ids))
    {
      // RETURN RECORDS FOR ALL EXCHANGES WITH SELECTED COINS
      $data = $trades->activeTrades()->whereIn('coin_id', $this->filter_coins_ids);
    }
    else
    {
      // RETURN RECORDS FOR SELECTED EXCHANGES AND SELECTED COINS

      $this->exchanges_coins = [];

      $user = User::where('id', auth()->id())->first();
      
      $trd = Trades::where('exchange_id', $this->filter_exchange_id)->get();

      foreach($trd as $trade) {
        $this->exchanges_coins[] = $trade->coin_id;
      }

      $this->user_coins = $user->coins->whereIn('id', $this->exchanges_coins);
      $data = $trades->activeTrades()->whereIn('coin_id', $this->filter_coins_ids)->whereIn('exchange_id', $this->filter_exchange_id);
    }
    return view('livewire.trades.active-trades')->withData($data);
  }
}