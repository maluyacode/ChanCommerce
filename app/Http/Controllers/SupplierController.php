<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\DataTables\SupplierDataTable;
use App\Models\Supplier;
use Barryvdh\Debugbar\Facades\Debugbar;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::with('media')->get();
        Debugbar::addMessage($suppliers);
        return response()->json($suppliers);
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path("suppliers/images");
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'sup_name' => 'required|string|max:255',
            'sup_contact' => 'required|string|max:255',
            'sup_address' => 'required|string|max:255',
            'sup_email' => 'required|string|email|max:255|unique:suppliers',
        ], [
            'sup_name.required' => 'Please enter supplier name.',
            'sup_contact.required' => 'Please enter supplier contact information.',
            'sup_address.required' => 'Please enter supplier address.',
            'sup_email.required' => 'Please enter supplier email address.',
            'sup_email.email' => 'Please enter a valid email address.',
            'sup_email.unique' => 'This email address has already been registered.',
        ])->validate();

        $supplier = new Supplier;
        $supplier->sup_name = $request->sup_name;
        $supplier->sup_contact = $request->sup_contact;
        $supplier->sup_address = $request->sup_address;
        $supplier->sup_email = $request->sup_email;

        if ($request->document !== null) {
            foreach ($request->input("document", []) as $file) {
                $supplier->addMedia(storage_path("suppliers/images/" . $file))->toMediaCollection("images");
            }
        }

        $supplier->save();
        return response()->json($supplier, 200, [], 0);
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
        $supplier =  Supplier::find($id);
        return response()->json($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'sup_name' => 'required',
            'sup_contact' => 'required',
            'sup_address' => 'required',
            'sup_email' => 'required|email',
        ])->validate();

        $supplier = Supplier::find($id);
        $supplier->sup_name = $request->sup_name;
        $supplier->sup_contact = $request->sup_contact;
        $supplier->sup_address = $request->sup_address;
        $supplier->sup_email = $request->sup_email;

        if ($request->document !== null) {
            DB::table('media')->where('model_id', $supplier->id)->where('model_type', 'App\Models\Supplier')->delete();
            foreach ($request->input("document", []) as $file) {
                $supplier->addMedia(storage_path("suppliers/images/" . $file))->toMediaCollection("images");
            }
        }
        $supplier->save();

        return response()->json($supplier, 200, [], 0);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Supplier::destroy($id);
        return response()->json([], 200, [], 0);
    }
    public function getSupplierMedia($id)
    {
        $supplier = Supplier::find($id);
        $supplier->getMedia('images');
        return response()->json($supplier);
    }
}
