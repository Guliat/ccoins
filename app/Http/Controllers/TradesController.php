<?php

namespace App\Http\Controllers;

use Session;
use App\Coins;
use App\Trades;
use App\Exchanges;
use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class TradesController extends Controller {
    
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

        $trades = Trades::where('is_active', 0)->get();
        return view('trades.closed')->withTrades($trades);

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

        $exchange = Exchanges::where('name', $request->exchange)->first('id');
        $coin = Coins::where('name', $request->coin)->first('id');

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

    public function delete(Trades $trades) {

        $trades->is_active = 0;
        $trades->save();
        
        Session::flash('deleted');
        return redirect()->back();
    }

}
