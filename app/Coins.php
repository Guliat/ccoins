<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coins extends Model
{
    public function trades()
    {
        return $this->hasMany('App\Trades', 'coin_id');
    }
}
