<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coins extends Model {
    
    public function trades() {
        return $this->hasMany('App\Trades', 'coin_id')->where('is_active', 1);
    }

    public function users() {
        return $this->belongsToMany('App\User'); 
	}

}
