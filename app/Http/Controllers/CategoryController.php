<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Barryvdh\Debugbar\Facades\Debugbar;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use App\Models\Supplier;
use GuzzleHttp\Promise\Create;
use App\Models\Item;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'cat_name' => 'required|max:255|min:3',
        ];
        $messages = [
            'cat_name.required' => 'Please enter your category name.',

        ];
        Validator::make($request->all(), $rules, $messages);

        Category::create([
            "cat_name" => $request->cat_name,
        ])->save();

        return response()->json([], 200, [], 0);
    }

    /**
     * Display the specified resource.
     */


    public function show($id)
    {
        // dd($id);
        $items = Item::with(['category', 'supplier', 'media'])->where('cat_id', $id)->orderBy('items.id', 'ASC')->paginate(4);
        $categories = Category::all();
        $suppliers = Supplier::all();
        // dd($items);
        return view::make('items.show', compact('items', 'categories'))->with('message', 'Product Added to Cart!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category =  Category::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'cat_name' => 'required|max:255|min:3',
        ];
        $messages = [
            'cat_name.required' => 'Please enter your category name.',

        ];
        Validator::make($request->all(), $rules, $messages);

        $categories = Category::find($id);
        $categories->cat_name = $request->cat_name;
        $categories->save();

        return response()->json([], 200, [], 0);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return response()->json([], 200, [], 0);
    }
}
