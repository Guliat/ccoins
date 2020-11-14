<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Trades extends Model
{
    public function exchange()
    {
        return $this->belongsTo('App\Exchanges', 'exchange_id');
    }

    public function coin()
    {
        return $this->belongsTo('App\Coins', 'coin_id');
    }

    public function trade()
    {
        return $this->belongsTo('App\Trades', 'referal_trade_id');
    }
    
    static public function totalBtc($exchange_id) {
        $total = null;
        $trades = Trades::where('is_active', 1)->where('exchange_id', $exchange_id)->where('user_id', auth()->id())->where('coin_id', 1)->get('quantity');
        foreach($trades as $trade) {
            $total += $trade->quantity;
        }
        return $total;
    }

}
