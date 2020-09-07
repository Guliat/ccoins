<?php
namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Coins;
use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;


class CoinsController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $user = User::find(Auth::id());
        $coins = $user->coins;
        return view('coins.index')->withCoins($coins);
    }

    public function create() {
        $coins = Coins::all();
        return view('coins.create')->withCoins($coins);
    }

    public function store(Request $request) {
        $coin = Coins::where('name', $request->coin)->select('id')->first();
        $store = User::find(Auth::id());
        $store->coins()->sync($coin, false);
        Session::flash('added');
        return redirect()->route('coins.index');
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