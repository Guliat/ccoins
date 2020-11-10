<?php

namespace App\Http\Livewire\Trades;

use App\User;
use Livewire\Component;
use App\Http\Controllers\TradesController;

class ActiveTrades extends Component {

  public $user_exchanges = '';
  public $user_coins = '';
  public $filter_exchanges = [0];
  public $filter_coins = [];
  // public $sort = '';
  // public $direction = 'asc';

  public function mount() {
    $user = User::where('id', auth()->id())->first();
    $this->user_coins = $user->coins;
    $this->user_exchanges = $user->exchanges;
  }

  // public function change_direction()
  // {
  //   if($this->direction == 'asc') {
  //     $this->direction = 'desc';
  //   } else {
  //     $this->direction = 'asc';
  //   }
  // }

  public function render() {
    $trades = new TradesController;
    if ($this->filter_exchanges[0] == 0 && empty($this->filter_coins))
    {
      // RETURN ALL RECORDS
      $data = $trades->activeTrades();
    }
    elseif ($this->filter_exchanges[0] == 0 && !empty($this->filter_coins))
    {
      // RETURN RECORDS FOR ALL EXCHANGES WITH SELECTED COINS
      $data = $trades->activeTrades()->whereIn('coin_id', $this->filter_coins);
    }
    else
    {
      // RETURN RECORDS FOR SELECTED EXCHANGES AND SELECTED COINS
      $data = $trades->activeTrades()->whereIn('coin_id', $this->filter_coins)->whereIn('exchange_id', $this->filter_exchanges);
    }
    return view('livewire.trades.active-trades')->withData($data);
  }
}