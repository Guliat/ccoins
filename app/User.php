<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public function coins() {
        return $this->belongsToMany('App\Coins', 'users_coins', 'user_id', 'coin_id')->withPivot('note')->withTimestamps();
    }

    public function exchanges() {
        return $this->belongsToMany('App\Exchanges', 'users_exchanges', 'user_id', 'exchange_id')->withPivot('note')->withTimestamps();
    }

    public function trades() {
        return $this->hasMany('App\Trades');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
