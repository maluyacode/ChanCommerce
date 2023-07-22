<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Order;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\Shipper;
use App\Models\Stock;
use App\Cart;
use Auth;
use View;
use Illuminate\Support\Facades\Session;

Use Storage;
Use DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::all();
        $suppliers = Supplier::all();

        $items = DB::table('items')
        ->join('categories', 'items.cat_id', '=', 'categories.id')
        ->join('suppliers','items.sup_id','=','suppliers.id')
        ->select('items.id as it_id','items.*','categories.*','suppliers.*')
        ->orderBy('items.id','ASC')->get();
        return View::make('items.index',compact('categories','items','suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();

        $categories = Category::all();
        return View::make('items.create',compact('suppliers','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [    'item_name' => 'required|string|max:255',    'sellprice' => 'required|numeric|min:0',    'sup_id' => 'required',    'cat_id' => 'required',    'img_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',];
$messages = [    'item_name.required' => 'Item name is required.',    'item_name.string' => 'Item name must be a string.',    'item_name.max' => 'Item name must not exceed :max characters.',    'sellprice.required' => 'Sell price is required.',    'sellprice.numeric' => 'Sell price must be a number.',    'sellprice.min' => 'Sell price must be at least :min.',    'sup_id.required' => 'Supplier is required.',    'cat_id.required' => 'Category is required.',      'img_path.required' => 'Image is required.',    'img_path.image' => 'The file must be an image.',    'img_path.mimes' => 'The image must be of type: :values.',    'img_path.max' => 'The image size must not exceed :max kilobytes.',];

$validator = Validator::make($request->all(), $rules, $messages);
if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
}
        $item = new Item;

        if($request->file()) {
            $fileName = time().'_'.$request->file('img_path')->getClientOriginalName();

            // $filePath = $request->file('img_path')->storeAs('uploads', $fileName,'public');
            // dd($fileName,$filePath);

            $path = Storage::putFileAs(
                'public/images', $request->file('img_path'), $fileName
            );
            $item->img_path = '/storage/images/' . $fileName;

        }
        $item->item_name = $request->item_name;
        $item->sellprice = $request->sellprice;
        $item->sup_id = $request->sup_id;
        $item->cat_id = $request->cat_id;
         //dd($item);

        $item->save();
        return redirect()->route('items.index');
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
    public function edit(string $id)
    {
        //$item =  Item::find($id);
        $item = DB::table('items')
        ->join('categories', 'items.cat_id', '=', 'categories.id')
        ->join('suppliers','items.sup_id','=','suppliers.id')
        ->select('items.id as it_id','suppliers.id AS s_id','items.*','categories.*','suppliers.*')
       ->where('items.id',$id)
       ->first();
    //
    // $suppliers = Supplier::all();
       $suppliers = Supplier::where('id', '<>', $item->s_id)->get(['sup_name','id']);
       $categories = Category::where('id', '<>', $item->cat_id)->get(['cat_name','id']);
        return view('items.edit', compact('item','suppliers','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [    'item_name' => 'required|string|max:255',    'sellprice' => 'required|numeric|min:0',    'sup_id' => 'required',    'cat_id' => 'required',    'img_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',];
        $messages = [    'item_name.required' => 'Item name is required.',    'item_name.string' => 'Item name must be a string.',    'item_name.max' => 'Item name must not exceed :max characters.',    'sellprice.required' => 'Sell price is required.',    'sellprice.numeric' => 'Sell price must be a number.',    'sellprice.min' => 'Sell price must be at least :min.',    'sup_id.required' => 'Supplier is required.',    'cat_id.required' => 'Category is required.',      'img_path.required' => 'Image is required.',    'img_path.image' => 'The file must be an image.',    'img_path.mimes' => 'The image must be of type: :values.',    'img_path.max' => 'The image size must not exceed :max kilobytes.',];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $item = Item::find($id);

        if($request->file()) {
            $fileName = time().'_'.$request->file('img_path')->getClientOriginalName();

            // $filePath = $request->file('img_path')->storeAs('uploads', $fileName,'public');
            // dd($fileName,$filePath);

            $path = Storage::putFileAs(
                'public/images', $request->file('img_path'), $fileName
            );
            $item->img_path = '/storage/images/' . $fileName;

        }
        $item->item_name = $request->item_name;
        $item->sellprice = $request->sellprice;
        $item->sup_id = $request->sup_id;
        $item->cat_id = $request->cat_id;
        // dd($artist);

        $item->save();
        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return redirect()->route('items.index');
    }
    public function getItems(Request $request){
        

        $categories = Category::all();
        $suppliers = Supplier::all();

        $items = DB::table('items')
        ->join('categories', 'items.cat_id', '=', 'categories.id')
        ->join('suppliers','items.sup_id','=','suppliers.id')
        ->select('items.id as it_id','items.*','categories.*','suppliers.*')
        ->orderBy('items.id','ASC')->get();
        $categoryId = $request->input('category_id');

        return View::make('items.welcome',compact('items','categories','suppliers','categoryId'));
    }
    public function search(Request $request)
{
    $query = $request->get('q');
    $items = Item::search($query)->get();
    $categories = Category::all();

    return view('items.welcome', compact('items','categories'))->with('message','Product Added to Cart!');
}
public function search2(Request $request)
{
    $query = $request->get('q');
    $items = Item::search($query)->get();
    $categories = Category::all();

    return view('transact.dashboard', compact('items','categories'));
}
public function checkAvailability($itemId)
{
    $stock = Stock::where('item_id', $itemId)->first();
    $available = ($stock->quantity > 0);
    return response()->json(['available' => $available]);
}


}