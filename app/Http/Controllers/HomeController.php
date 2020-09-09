<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index() {
        return view('welcome');
    }

    public function updatePrices() {
        $coins = Coins::all();
        $client = new CoinGeckoClient();
        foreach($coins as $coin) {
            $data = $client->simple()->getPrice($coin->api_link, 'usd');
            $update = Coins::find($coin->id);
            $update->price = $data[$coin->api_link]['usd'];
            $update->save();
        }
    }
}
