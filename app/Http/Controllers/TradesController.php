<?php

namespace App\Http\Controllers;

// use Auth;
use App\User;
use App\Coins;
use App\Trades;
use App\Exchanges;
use Illuminate\Http\Request;
use App\Services\TradeService;
use Illuminate\Support\Facades\Session;

class TradesController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function livewireTrades()
    {
			$calc= new TradeService;
			$result = collect();
			$trades = Trades::where('user_id', auth()->id())->where('is_active', 1)->get();
      foreach($trades as $trade) {
        $trade['available'] = $calc->calculateAvailable($trade->quantity, $trade->coin->price);
        $trade['paid'] = $calc->calculatePaid($trade->quantity, $trade->open_price);
        $trade['profit'] = $calc->calculateProfit($trade->quantity, $trade->coin->price, $trade->open_price);
        $result->push($trade);
      }
            return $result;
		}
		
    
    public function activeTrades() {
        $active_trades = Trades::where('user_id', auth()->id())->where('is_active', 1)->get();
        $bitcoin = Coins::where('name', 'bitcoin')->select('price')->first();

        $json=null;
        foreach($active_trades as $trade) {
            $profit = number_format((($trade->quantity*$trade->coin->price)-($trade->quantity*$trade->open_price)), 2, '.', '');
            $available = number_format($trade->quantity*$trade->coin->price, 3, '.', '');
            $json .= '{"id": '.$trade->id.', "exchange": "'.$trade->exchange->name.'", "coin": "'.$trade->coin->symbol.'", "quantity": '.$trade->quantity.', "available": '.$available.', "profit": '.$profit.'  }, ';
        }

        return view('trades.active')->withTrades($json);
    }

    public function closedTrades() {
        $trades = Trades::where('user_id', auth()->id())->where('is_active', 0)->orderBy('coin_id')->get();
        return view('trades.closed')->withTrades($trades);
    }

    public function tradesPerCoins() {
        $user = User::find(auth()->id());
        $coins = $user->coins;
        return view('trades.per_coins')->withCoins($coins);
    }

    public function tradesPerExchanges() {
        $user = User::find(auth()->id());
        $exchanges = $user->exchanges;  
        $coins = $user->coins;
        return view('trades.per_exchanges')->withExchanges($exchanges)->withCoins($coins);
    }

    public function create() {

        $user = User::find(auth()->id());
        $coins = $user->coins;
        $exchanges = $user->exchanges;

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
        $trade->user_id = auth()->id();
        $trade->exchange_id = $exchange->id;
        $trade->coin_id = $coin->id;
        $trade->quantity = $request->quantity;
        $trade->open_price = $request->open_price;
        $trade->save();

        Session::flash('added');
        return redirect()->route('trades.active');
    }

    public function update(Trades $trades, Request $request) {
        if($request->session()->token() == $request->_token) {
            $this->validate($request, array(
                'quantity' => 'required',
            ));

            $trades->quantity = $request->quantity;
            $trades->open_price = $request->open_price;
            $trades->save();

            Session::flash('updated'); // Flash UI Toast message
            return redirect()->back(); // Return back to active trades
        } else {
            return abort(404);
        }
    }

    public function convert(Trades $trades, Request $request) {
        if($request->session()->token() == $request->_token) {
            // --- sum Profit/Loss
            $profit_loss = ($request->bitcoin_quantity*$request->bitcoin_price)-($trades->quantity*$trades->open_price);
            // IF user close partial quantity
            if($request->quantity < $trades->quantity) {
                // --- sum new quantity
                $quantity = $trades->quantity - $request->quantity;
                // --- make NEW Bitcoin trade
                $trade = new Trades;
                $trade->user_id = auth()->id();
                $trade->exchange_id = $trades->exchange_id;
                $trade->coin_id = 1;
                $trade->open_price = $request->bitcoin_price;
                $trade->quantity = $request->bitcoin_quantity;
                $trade->referal_trade_id = $trades->id;
                $trade->save();
                // --- make NEW converted coin trade with new quantity
                $trade = new Trades;
                $trade->user_id = auth()->id();
                $trade->exchange_id = $trades->exchange_id;
                $trade->coin_id = $trades->coin_id;
                $trade->open_price = $trades->open_price;
                $trade->quantity = $quantity;
                $trade->save();
                // --- update converted coin trade and make it unactive
                $trades->close_quantity = $request->quantity;
                $trades->bitcoin_quantity = $request->bitcoin_quantity;
                $trades->bitcoin_price = $request->bitcoin_price;
                $trades->profit_loss = $profit_loss;
                $trades->is_active = 0;
                $trades->save();
            } else {
                // --- make NEW Bitcoin trade
                $trade = new Trades;
                $trade->user_id = auth()->id();
                $trade->exchange_id = $trades->exchange_id;
                $trade->coin_id = 1;
                $trade->open_price = $request->bitcoin_price;
                $trade->quantity = $request->bitcoin_quantity;
                $trade->referal_trade_id = $trades->id;
                $trade->save();
                // --- update converted coin trade and make it unactive
                $trades->close_quantity = $request->quantity;
                $trades->bitcoin_quantity = $request->bitcoin_quantity;
                $trades->bitcoin_price = $request->bitcoin_price;
                $trades->profit_loss = $profit_loss;
                $trades->is_active = 0;
                $trades->save();

            }
            Session::flash('updated'); // Flash UI Toast message
            return redirect()->back(); // Return back to active trades
        } else {
            return abort(404);
        }
    }

    public function sell(Trades $trades, Request $request) {
        if($request->session()->token() == $request->_token) {
            // --- sum Profit/Loss
            $profit_loss = ($request->quantity*$request->close_price)-($request->quantity*$trades->open_price);
            // IF user close partial quantity
            if($request->quantity < $trades->quantity) {
                // --- sum new quantity
                $quantity = $trades->quantity - $request->quantity;
                // --- make NEW trade with old data and new quantity
                $trade = new Trades;
                $trade->user_id = auth()->id();
                $trade->exchange_id = $trades->exchange_id;
                $trade->coin_id = $trades->coin_id;
                $trade->open_price = $trades->open_price;
                $trade->quantity = $quantity;
                $trade->save();
                // update CURRENT trade and make it unactive
                $trades->close_quantity = $request->quantity;
                $trades->close_price = $request->close_price;
                $trades->profit_loss = $profit_loss;
                $trades->is_active = 0;
                $trades->save();
            // ELSE update CURRENT trade and make it unactive
            } else {
                $trades->close_quantity = $request->quantity;
                $trades->close_price = $request->close_price;
                $trades->profit_loss = $profit_loss;
                $trades->is_active = 0;
                $trades->save();
            }
            Session::flash('updated'); // Flash UI Toast message
            return redirect()->back(); // Return back to active trades
        } else {
            return abort(404);
        }    
    }

}
