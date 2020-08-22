<?php

namespace App\Http\Controllers;

use App\Trades;
use Illuminate\Http\Request;

class TradesController extends Controller {
    
    public function index() {
        return view('trades.index');
    }

    public function create() {
        return view('trades.create');
    }

    public function edit(Trades $trades) {
        return view('trades.edit');
    }

}
