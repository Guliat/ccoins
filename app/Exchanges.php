<?php
namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Exchanges extends Model {

    public function trades() {
        return $this->hasMany('App\Trades', 'exchange_id')->where('is_active', 1)->where('user_id', Auth::id());
    }
    
    public function users() {
        return $this->belongsToMany('App\User', 'users_exchanges', 'exchange_id', 'user_id')->withTimestamps(); 
    }
    
}
