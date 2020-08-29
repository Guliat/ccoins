<?php
namespace App\Http\Controllers;

use Session;
use App\Exchanges;
use Illuminate\Http\Request;

class ExchangesController extends Controller {
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $exchanges = Exchanges::all();
        return view('exchanges.index')->withExchanges($exchanges);
    }

    public function create() {
        return view('exchanges.create');
    }

    public function store(Request $request) {

        $this->validate($request, array(
            'name' => 'required|max:255|unique:exchanges,name',
        ));

        $exchanges = new Exchanges;
        $exchanges->name = $request->name;
        $exchanges->save();

        Session::flash('added');
        return redirect()->route('exchanges.index');
    }

    public function edit(Exchanges $exchanges) {
        return view('exchanges.edit')->withExchange($exchanges);
    }

    public function update(Request $request, Exchanges $exchanges) {

        $this->validate($request, array(
            'name' => 'required|max:255|unique:exchanges,name',
        ));

        $exchanges->name = $request->name;
        $exchanges->save();

        Session::flash('updated');
        return redirect()->route('exchanges.index');
    }

    public function delete(Exchanges $exchanges) {

        $exchanges->is_active = 0;
        $exchanges->save();
        
        Session::flash('deleted');
        return redirect()->back();
    }

    public function unDelete(Exchanges $exchanges) {
        
        $exchanges->is_active = 1;
        $exchanges->save();
        
        Session::flash('undeleted');
        return redirect()->back();
    }
}
