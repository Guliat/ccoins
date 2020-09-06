<?php
namespace App\Http\Controllers;

use Session;
use App\Exchanges;
use Illuminate\Http\Request;

class ManageExchangesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $exchanges = Exchanges::all();
        return view('manage.exchanges.index')->withExchanges($exchanges);
    }

    public function create() {
        return view('manage.exchanges.create');
    }

    public function store(Request $request) {

        $this->validate($request, array(
            'name' => 'required|max:255|unique:exchanges,name',
        ));

        $exchanges = new Exchanges;
        $exchanges->name = $request->name;
        $exchanges->save();

        Session::flash('added');
        return redirect()->route('manage.exchanges.index');
    }

    public function edit(Exchanges $exchanges) {
        return view('manage.exchanges.edit')->withExchange($exchanges);
    }

    public function update(Request $request, Exchanges $exchanges) {

        $this->validate($request, array(
            'name' => 'required|max:255|unique:exchanges,name',
        ));

        $exchanges->name = $request->name;
        $exchanges->save();

        Session::flash('updated');
        return redirect()->route('manage.exchanges.index');
    }
    
}
