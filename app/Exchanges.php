<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exchanges extends Model {
    
    public function users() {
        return $this->belongsToMany('App\User', 'users_exchanges', 'exchange_id', 'user_id')->withTimestamps(); 
    }
    
}
