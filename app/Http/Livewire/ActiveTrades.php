<?php

namespace App\Http\Livewire;

use Auth;
use App\User;
use App\Trades;
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
    public $filter_exchange = '';
    public $filter_coin = '';
    public $user_coins = '';
    public $user_exchanges = '';

    public function mount()
    {
      $user = User::where('id', Auth::id())->first();
      $this->user_coins = $user->coins;
      $this->user_exchanges = $user->exchanges;
    }
    
    public function render()
    {

    $trades = new TradesController;
    if(empty($this->filter_exchange && $this->filter_coin))
    {
      $data = $trades->livewireTrades();
    }
    elseif(empty($this->filter_exchange))
    {
      $data = $trades->livewireTrades()->where('coin_id', $this->filter_coin);
    }
    elseif(empty($this->filter_coin))
    {
      $data = $trades->livewireTrades()->where('exchange_id', $this->filter_exchange);
    }
    else
    {
      $data = $trades->livewireTrades()->where('coin_id', $this->filter_coin)->where('exchange_id', $this->filter_exchange);
    }


    // if($this->filter_coin)
    
    // {
    //   $data = Trades::
    //     where('user_id', Auth::id())->
    //     where('is_active', 1)->
    //     where('coin_id', $this->filter_coin)->
    //     get();

    //   $this->filter_exchange = '';
    // }


    // if($this->filter_exchange)
    // {
    //   $data = Trades::
    //     where('user_id', Auth::id())->
    //     where('is_active', 1)->
    //     where('exchange_id', $this->filter_exchange)->
    //     get();

    //   $this->filter_coin = '';
    // }


      return view('livewire.active-trades')->withData($data);

        // return view('livewire.active-trades', [
        //     'trades' => Trades::search($this->search)
        //         ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
        //         ->simplePaginate($this->perPage),
        // ]);
    }


}