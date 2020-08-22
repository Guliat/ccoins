<?php

namespace App\Http\Controllers;

use App\Exchanges;
use Illuminate\Http\Request;

class ExchangesController extends Controller {

    public function index() {
        return view('exchanges.index');
    }

    public function create() {
        return view('exchanges.create');
    }

    public function edit(Exchanges $exchanges) {
        return view('exchanges.edit');
    }
}
