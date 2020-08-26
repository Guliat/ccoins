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
}
