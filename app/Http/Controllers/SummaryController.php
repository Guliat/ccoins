<?php
namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Coins;
use App\Trades;
use App\Exchanges;
use Illuminate\Http\Request;

class SummaryController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {

		$user = User::find(Auth::id());
		$bitcoin = Coins::where('name', 'bitcoin')->select('price')->first();

		$active_trades = Trades::where('user_id', $user->id)->where('is_active', 1)->get();

		$closed_trades = Trades::where('user_id', $user->id)->where('is_active', 0)->orderBy('coin_id')->get();

		$exchanges = $user->exchanges;
		$coins = $user->coins;

		
		// Total (for all coins and exchanges) closed trades Profit / Loss
		$totalClosedPL = null;
		foreach($closed_trades as $closed_trade) {
			$totalClosedPL += $closed_trade->profit_loss;
		}
		// Total active Profit / Loss & Total Available
		$totalActivePL = null;
		$totalAvailable = null;
		foreach($active_trades as $active_trade) {
			// Sum total active trades Profit / Loss
			$totalActivePL += ($active_trade->quantity*$active_trade->coin->price)-($active_trade->quantity*$active_trade->open_price);
			// Sum total available
			$totalAvailable += $active_trade->coin->price*$active_trade->quantity;
		}




		
		$totalCoins = count($coins);
		$totalExchanges = count($exchanges);
		$activeTrades = count($active_trades);
		$closedTrades = count($closed_trades);
		$totalTrades = $activeTrades + $closedTrades;


		return view('summary.index')
			->withTotalCoins($totalCoins)
			->withTotalExchanges($totalExchanges)
			->withTotalTrades($totalTrades)
			->withClosedTrades($closedTrades)
			->withActiveTrades($activeTrades)
			->withTotalClosedPL($totalClosedPL)
			->withTotalActivePL($totalActivePL)
			->withTotalAvailable($totalAvailable)
			->withAllClosedTrades($closed_trades);
		;
	}

}
