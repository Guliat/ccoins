<?php
namespace App\Http\Controllers;

use Session;
use App\Coins;
use Illuminate\Http\Request;

class CoinsController extends Controller {
    
    public function index() {
        $coins = Coins::all();
        return view('coins.index')->withCoins($coins);
    }

    public function create() {
        return view('coins.create');
    }

    public function store(Request $request) {

        $this->validate($request, array(
            'symbol' => 'required|max:255|unique:coins,symbol',
            'name' => 'required|max:255|unique:coins,name',
            'api_link' => 'required|max:255|unique:coins,api_link',
        ));

        $coins = new Coins;
        $coins->symbol = $request->symbol;
        $coins->name = $request->name;
        $coins->api_link = $request->api_link;
        $coins->save();

        Session::flash('added');
        return redirect()->route('coins.index');
    }

    public function edit(Coins $coins) {
        return view('coins.edit')->withCoin($coins);
    }

    public function update(Request $request, Coins $coins) {

        $this->validate($request, array(
            'symbol' => 'required|max:255',
            'name' => 'required|max:255',
            'api_link' => 'required|max:255',
        ));

        $coins->symbol = $request->symbol;
        $coins->name = $request->name;
        $coins->api_link = $request->api_link;
        $coins->save();

        Session::flash('updated');
        return redirect()->route('coins.index');
    }

    public function delete(Coins $coins) {

        $coins->is_active = 0;
        $coins->save();
        
        Session::flash('deleted');
        return redirect()->back();
    }

    public function unDelete(Coins $coins) {
        
        $coins->is_active = 1;
        $coins->save();
        
        Session::flash('undeleted');
        return redirect()->back();
    }

}