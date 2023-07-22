<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $items = Item::all();
        $stocks = DB::table('items')
            ->join('stocks', 'id', '=', 'stocks.item_id')
            ->orderBy('stocks.item_id', 'ASC')->get();

        return View::make('stocks.index', compact('stocks', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        return View::make('stocks.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'quantity' => 'required|numeric|min:0',
        ];
        $messages = [
            'quantity.required' => 'Please enter Quantity.',
            'quantity.numeric' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity must be at least :min.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $findStock = Stock::find($request->item_id);
        if (!$findStock) {
            $stock = new Stock;
            $stock->item_id = $request->item_id;
            $stock->quantity = $request->quantity;
            $stock->save();
        } else {
            $findStock->quantity = $findStock->quantity + $request->quantity;
            $findStock->save();
        }
        return redirect()->route('stocks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $stockid = Stock::find($item_id);
        // dd($stockid);

        $stock = DB::table('items AS is')
            ->select('is.id', 'ss.item_id', 'is.item_name', 'ss.quantity')
            ->join('stocks AS ss', 'ss.item_id', '=', 'is.id')
            ->where('ss.item_id', $id)
            ->first();
        //dd($stock)

        $items = Item::where('id', '<>', $stock->item_id)->get(['item_name', 'id']);

        return View::make('stocks.edit', compact('items', 'stock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'quantity' => 'required|numeric|min:0',
        ];
        $messages = [
            'quantity.required' => 'Please enter Quantity.',
            'quantity.numeric' => 'Quantity must be a number.',
            'quantity.min' => 'Quantity must be at least :min.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $stock = Stock::find($id);

        $stock->item_id = $request->item_id;
        $stock->quantity = $request->quantity;

        if ($stock->quantity > 0) {
            Item::where('id', $stock->item_id)
                ->update([
                    "description" => "On Stock",

                ]);
        }

        $stock->save();
        return redirect()->route('stocks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Stock::destroy($id);
        return back();
    }
}
