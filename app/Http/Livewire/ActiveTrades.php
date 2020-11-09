<?php

namespace App\Http\Livewire;

// use Auth;
use App\User;
// use App\Trades;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Controllers\TradesController;

class ActiveTrades extends Component
{
  use WithPagination;

    // public $perPage = 10;
    // public $search = '';
    // public $orderBy = 'id';
    // public $orderAsc = true;

  public $user_exchanges = '';
  public $user_coins = '';
  public $filter_exchanges = [];
  public $filter_coins = [];

  public function mount()
  {
    $user = User::where('id', auth()->id())->first();
    $this->user_coins = $user->coins;
    $this->user_exchanges = $user->exchanges;

    foreach($user->coins as $coin) {
      $this->filter_coins = $coin->name;
    }

  }
    

  public function render()
  {
    
    $trades = new TradesController;

    // if(empty($this->filter_exchange && $this->filter_coin))
    // {
    // $data = $trades->livewireTrades()->whereIn('coin_id', [$this->filter_coins])->whereIn('exchange_id', [$this->filter_exchanges]);
    $data = $trades->livewireTrades()->whereIn('coin_id', $this->filter_coins)->whereIn('exchange_id', $this->filter_exchanges);
    // }

    // if(!empty($this->filter_exchange || $this->filter_coin))
    // {
    //   if(!empty($this->filter_coin) && empty($this->filter_exchange))
    //   {
    //     $data = $trades->livewireTrades()->where('coin_id', $this->filter_coin);
    //     $this->filter_exchange = '';
    //   }
    //   elseif(!empty($this->filter_exchange))
    //   {
    //     $data = $trades->livewireTrades()->where('exchange_id', $this->filter_exchange);
    //     $this->filter_coin = '';
    //   }
    // }

    return view('livewire.active-trades')->withData($data);


    // return view('livewire.active-trades', [
        //     'trades' => Trades::search($this->search)
        //         ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
        //         ->simplePaginate($this->perPage),
        // ]);


  }
}