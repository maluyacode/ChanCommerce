<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Supplier;
Use View;
Use Storage;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::all();
        //dd(compact('items'));
        return View::make('suppliers.index',compact('supplier'));
    
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
        $validator = Validator::make($request->all(), [
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
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $supplier = new Supplier;
        $supplier->sup_name = $request->sup_name;
        $supplier->sup_contact = $request->sup_contact;
        $supplier->sup_address = $request->sup_address;
        $supplier->sup_email = $request->sup_email;
           
        $supplier->save();
        return redirect()->route('suppliers.index');
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
    public function edit(string $id)
    {
        $supplier =  Supplier::find($id);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'sup_name' => 'required',
            'sup_contact' => 'required',
            'sup_address' => 'required',
            'sup_email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->route('suppliers.create')
                ->withErrors($validator)
                ->withInput();
        }
    
        $supplier = new Supplier;
               
        $supplier->sup_name = $request->sup_name;
        $supplier->sup_contact = $request->sup_contact;
        $supplier->sup_address = $request->sup_address;
        $supplier->sup_email = $request->sup_email;
           
        $supplier->save();
        return redirect()->route('suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Supplier::destroy($id);
        return redirect()->route('Suppliers.index');
    }
}
