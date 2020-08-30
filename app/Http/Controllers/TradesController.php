<?php

namespace App\Http\Controllers;

use Session;
use App\Coins;
use App\Trades;
use App\Exchanges;
use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class TradesController extends Controller {
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function activeTrades() {
        
        $get_coins = Coins::select('api_link')->get();

        $coins = '';
        foreach($get_coins as $coin) {
            $coins .= $coin->api_link.",";
        }

        $client = new CoinGeckoClient();
        $data = $client->simple()->getPrice($coins, 'usd');
       
        $trades = Trades::where('is_active', 1)->get();

        return view('trades.active')->withTrades($trades)->withData($data);

    }

    public function closedTrades() {

        $trades = Trades::where('is_active', 0)->orderBy('coin_id')->get();
        $coins = Coins::where('is_active', 1)->get();
        $coinss = '';

        foreach($coins as $coin) {
            $coinss .= $coin->api_link.",";
        }

        // GET Current prices from CoinGecko API
        $client = new CoinGeckoClient();
        $data = $client->simple()->getPrice($coinss, 'usd');

        return view('trades.closed')->withTrades($trades)->withData($data);

    }

    public function tradesPerCoins() {

        $trades = Trades::where('is_active', 1)->get();

        $coins = Coins::where('is_active', 1)->get();



        $coinss = '';

        foreach($coins as $coin) {
            $coinss .= $coin->api_link.",";
        }

       
        // GET Current prices from CoinGecko API
        $client = new CoinGeckoClient();
        $data = $client->simple()->getPrice($coinss, 'usd');
        

            

        return view('trades.per_coins')
            ->withCoins($coins)
            ->withTrades($trades)
           ->withData($data)
            ;

    }

    public function create() {

        $coins = Coins::where('is_active', 1)->get();
        $exchanges = Exchanges::where('is_active', 1)->get();

        return view('trades.create')
            ->withCoins($coins)
            ->withExchanges($exchanges);
    }

    public function store(Request $request) {

        $this->validate($request, array(
            'exchange' => 'required',
            'coin' => 'required',
            'quantity' => 'required',
        ));
        
        $coin_name = explode(' - ',trim($request->coin));
        $exchange = Exchanges::where('name', $request->exchange)->first('id');
        $coin = Coins::where('name', $coin_name[0])->first('id');       

        $trade = new Trades;
        $trade->exchange_id = $exchange->id;
        $trade->coin_id = $coin->id;
        $trade->quantity = $request->quantity;
        $trade->open_price = $request->open_price;
        $trade->save();

        Session::flash('added');
        return redirect()->route('trades.active');
    }
    
    public function edit(Trades $trades) {
        return view('trades.edit');
    }

    public function delete(Trades $trades, Request $request) {

        // IF user close partial quantity
        if($request->quantity < $trades->quantity) {
            // --- sum new quantity
            $quantity = $trades->quantity - $request->quantity;
            // --- make NEW trade with old data and new quantity
            $trade = new Trades;
            $trade->exchange_id = $trades->exchange_id;
            $trade->coin_id = $trades->coin_id;
            $trade->open_price = $trades->open_price;
            $trade->quantity = $quantity;
            $trade->save();
            // --- update CURRENT trade and make it unactive
            $trades->close_quantity = $request->quantity;
            $trades->close_price = $request->close_price;
            $trades->is_active = 0;
            $trades->save();

        // ELSE update CURRENT trade and make it unactive
        } else {
            $trades->close_quantity = $request->quantity;
            $trades->close_price = $request->close_price;
            $trades->is_active = 0;
            $trades->save();
        }
        Session::flash('updated'); // Flash UI Toast message
        return redirect()->back(); // Return back to active trades
    }

}
