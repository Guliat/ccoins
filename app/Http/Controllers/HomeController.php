<?php
namespace App\Http\Controllers;

use App\Coins;
use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class HomeController extends Controller {

    public function index() {
        return view('welcome');
    }

    static public function updatePrices() {
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
