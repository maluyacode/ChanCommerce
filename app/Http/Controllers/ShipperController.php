<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Shipper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ShipperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippers = Shipper::all();

        return View::make('shippers.index', compact('shippers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('shippers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'Shipper' => 'required|max:255|min:3',
        ];
        $messages = [
            'Shipper.required' => 'Please enter your Shipper name.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $shippers = new Shipper;


        $shippers->name = $request->Shipper;


        $shippers->save();
        return redirect()->route('shippers.index');
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
        $shippers =  Shipper::find($id);
        return view('shippers.edit', compact('shippers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'Shipper' => 'required|max:255|min:3',
        ];
        $messages = [
            'Shipper.required' => 'Please enter your Shipper name.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $shippers = Shipper::find($id);


        $shippers->name = $request->Shipper;


        $shippers->save();
        return redirect()->route('shippers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Shipper::destroy($id);
        return redirect()->route('shippers.index');
    }
}
