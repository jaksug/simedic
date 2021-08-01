<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Paket;
use Response;


class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $pakets = Paket::all();
        $pakets_ids = array();
        foreach($pakets as $paket) {
            $pakets_ids[$paket->id] = $paket->name;
        }
        return view('master_item', compact('items','pakets','pakets_ids'));
    }

    public function all_item($render=False)
    {
        $items = Item::all();
        $pakets = Paket::all();
        $pakets_ids = array();
        foreach($pakets as $paket) {
            $pakets_ids[$paket->id] = $paket->name;
        }

        if($render) {
            return view('items', compact('items','pakets','pakets_ids'))->render();
        }
        return view('items', compact('items','pakets','pakets_ids'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'paket' => 'required',
            'unit' => 'required',
            'hasil' => 'required',
            'nilai_normal' => 'required',
            'keterangan' => 'required',
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->paket = $request->paket;
        $item->unit = $request->unit;
        $item->hasil = $request->hasil;
        $item->nilai_normal = $request->nilai_normal;
        $item->keterangan = $request->keterangan;

        $item->save();
        $item->list = $this->all_item(True);
        return \Response::json($item);
    }

    public function update(Item $item_id, Request $request)
    {
        $item = Item::find($item_id)->first();
        $data = $request->validate([
            'name' => 'required',
            'paket' => 'required',
            'unit' => 'required',
            'hasil' => 'required',
            'nilai_normal' => 'required',
            'keterangan' => 'required',
        ]);

        $item->name = $request->name;
        $item->paket = $request->paket;
        $item->unit = $request->unit;
        $item->hasil = $request->hasil;
        $item->nilai_normal = $request->nilai_normal;
        $item->keterangan = $request->keterangan;

        $item->save();
        $item->list = $this->all_item(True);
        return \Response::json($item);
    }

    public function destroy(Item $item_id)
    {
        $item = Item::find($item_id)->first();
        $item->delete();
        return \Response::json($item);
    }
}
