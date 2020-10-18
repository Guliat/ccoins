<?php
namespace App\Http\Controllers;

use Mail;
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

    public function newUserCreated() {
        //TODO move to another controller and change in RegisterController
        Mail::raw('New registration in our system detected!', function ($message) {
            $message->from('guliat88@gmail.com', 'CCoins');
            $message->to('guliat88@mail.bg')->subject('New User Created');
        });
    }
    
}
