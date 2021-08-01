<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Paket;
use Response;



class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('master_paket', compact('pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $paket = new Paket();
        $paket->name = $request->name;
        $paket->save();
        return \Response::json($paket);
    }

    public function update(Paket $paket_id, Request $request)
    {
        $paket = Paket::find($paket_id)->first();
        $request->validate([
            'name' => 'required',
        ]);

        $paket->name = $request->name;
        $paket->save();
        return \Response::json($paket);
    }

    public function destroy(Paket $paket_id)
    {
        $paket = Paket::find($paket_id)->first();
        $paket->delete();
        return \Response::json($paket);
    }
}
