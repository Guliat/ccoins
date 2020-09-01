<?php

namespace App;

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
}
