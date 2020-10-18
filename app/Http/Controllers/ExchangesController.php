<?php
namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Exchanges;
use Illuminate\Http\Request;

class ExchangesController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = User::find(Auth::id());
        $exchanges = $user->exchanges;
        return view('exchanges.index')->withExchanges($exchanges);
    }

    public function create() {
        $exchanges = Exchanges::all();
        return view('exchanges.create')->withExchanges($exchanges);
    }

    public function store(Request $request) {
        $exchange = Exchanges::where('name', $request->exchange)->select('id')->first();
        $store = User::find(Auth::id());
        $store->exchanges()->sync($exchange, false);
        Session::flash('added');
        return redirect()->route('exchanges.index');
    }

    public function updateNote(Request $request) {
        $user = User::find(Auth::id());
        $user->exchanges()->updateExistingPivot($request->exchange_id, array('note' => $request->note));
        Session::flash('updated');
        return redirect()->back();
    }
}