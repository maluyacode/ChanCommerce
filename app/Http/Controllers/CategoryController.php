<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use App\Models\Supplier;

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

        try {
            $validatedData = $request->validate($rules, $messages);
            $categories = new Category;
            $categories->cat_name = $request->cat_name;

            $categories->save();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->with('alert', 'Please fix the errors below.')->withInput();
        }

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */


    public function show($id)
    {
        // dd($id);
        $items = DB::table('items')
            ->join('categories', 'items.cat_id', '=', 'categories.id')
            ->join('suppliers', 'items.sup_id', '=', 'suppliers.id')
            ->select('items.id as it_id', 'items.*', 'categories.*', 'suppliers.*')
            ->where('categories.id', $id)->get();
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view::make('items.show', compact('items', 'categories'))->with('message', 'Product Added to Cart!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories =  Category::find($id);
        return view('categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'cat_name' => 'required|max:255|min:3',
        ];
        $messages = [
            'cat_name.required' => 'Please enter your category name.',

        ];

        try {
            $validatedData = $request->validate($rules, $messages);
            $categories = Category::find($id);

            $categories->cat_name = $request->cat_name;

            $categories->save();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->with('alert', 'Please fix the errors below.')->withInput();
        }

        return redirect()->route('categories.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect()->route('categories.index');
    }
}
