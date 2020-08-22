<?php

namespace App\Http\Controllers;

use App\Coins;
use Illuminate\Http\Request;

class CoinsController extends Controller {
    
    public function index() {
        return view('coins.index');
    }

    public function create() {
        return view('coins.create');
    }

    public function edit(Coins $coins) {
        return view('coins.edit');
    }

}
