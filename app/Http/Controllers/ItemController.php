<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Stock;
use Barryvdh\Debugbar\Facades\Debugbar;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('supplier', 'category')->get();
        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all()->pluck('sup_name', 'id');
        $categories = Category::all()->pluck('cat_name', 'id');
        return response()->json(["suppliers" => $suppliers, "categories" => $categories]);
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path("items/images");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file("file");
        $name = uniqid() . "_" . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            "name" => $name,
            "original_name" => $file->getClientOriginalName(),
        ]);
    }

    public function store(Request $request)
    {
        Debugbar::info($request);
        $rules = [
            'item_name' => 'required|string|max:255',
            'sellprice' => 'required|numeric|min:0',
            'sup_id' => 'required',
            'cat_id' => 'required',
        ];
        $messages = [
            'item_name.required' => 'Item name is required.',
            'item_name.string' => 'Item name must be a string.',
            'item_name.max' => 'Item name must not exceed :max characters.',
            'sellprice.required' => 'Sell price is required.',
            'sellprice.numeric' => 'Sell price must be a number.',
            'sellprice.min' => 'Sell price must be at least :min.',
            'sup_id.required' => 'Supplier is required.',
            'cat_id.required' => 'Category is required.',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        $item = new Item;
        $item->item_name = $request->item_name;
        $item->sellprice = $request->sellprice;
        $item->sup_id = $request->sup_id;
        $item->cat_id = $request->cat_id;
        $item->img_path = "NONE";

        if ($request->document !== null) {
            foreach ($request->input("document", []) as $file) {
                $item->addMedia(storage_path("items/images/" . $file))->toMediaCollection("images");
            }
        }

        $item->save();

        DB::table('stocks')->insert([
            "item_id" => $item->id,
            "quantity" => 0,
        ]);

        return response()->json($item, $status = 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::with('supplier', 'category')->find($id);
        $item->getMedia('images');

        $suppliers = Supplier::whereNotIn('id', [$item->sup_id])->pluck('sup_name', 'id');
        $categories = Category::whereNotIn('id', [$item->cat_id])->pluck('cat_name', 'id');;

        return response()->json(["item" => $item, "suppliers" => $suppliers, "categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'item_name' => 'required|string|max:255',
            'sellprice' => 'required|numeric',
            'sup_id' => 'required',
            'cat_id' => 'required',
        ];
        $messages = [
            'item_name.required' => 'Item name is required.',
            'item_name.string' => 'Item name must be a string.',
            'item_name.max' => 'Item name must not exceed :max characters.',
            'sellprice.required' => 'Sell price is required.',
            'sellprice.numeric' => 'Sell price must be a number.',
            'sellprice.min' => 'Sell price must be at least :min.',
            'sup_id.required' => 'Supplier is required.',
            'cat_id.required' => 'Category is required.',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        $item = Item::find($id);
        $item->item_name = $request->item_name;
        $item->sellprice = $request->sellprice;
        $item->sup_id = $request->sup_id;
        $item->cat_id = $request->cat_id;

        if ($request->document !== null) {
            DB::table('media')->where('model_id', $id)->delete();
            foreach ($request->input("document", []) as $file) {
                $item->addMedia(storage_path("items/images/" . $file))->toMediaCollection("images");
            }
        }
        $item->save();
        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Debugbar::info($id);
        Item::destroy($id);
        return response()->json(["status" => 200]);
    }

    public function getItems(Request $request)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $userId = auth()->user()->id;
        $itemCount = DB::table('carts')->where('user_id', $userId)->count();

        $items = DB::table('items')
            ->join('categories', 'items.cat_id', '=', 'categories.id')
            ->join('suppliers', 'items.sup_id', '=', 'suppliers.id')
            ->select('items.id as it_id', 'items.*', 'categories.*', 'suppliers.*')
            ->orderBy('items.id', 'ASC')->paginate(4);
        $categoryId = $request->input('category_id');

        return View::make('items.welcome', compact('items', 'categories', 'suppliers', 'categoryId', 'itemCount'));
    }
    public function search(Request $request)
    {
        $query = $request->get('q');
        $items = Item::search($query)->get();
        $categories = Category::all();

        return view('items.welcome', compact('items', 'categories'))->with('message', 'Product Added to Cart!');
    }
    public function search2(Request $request)
    {
        $query = $request->get('q');
        $items = Item::search($query)->get();
        $categories = Category::all();

        return view('transact.dashboard', compact('items', 'categories'));
    }
    public function checkAvailability($itemId)
    {
        $stock = Stock::where('item_id', $itemId)->first();
        $available = ($stock->quantity > 0);
        return response()->json(['available' => $available]);
    }
}
