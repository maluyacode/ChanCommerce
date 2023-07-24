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
        return response()->json($shippers);
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
        Validator::make($request->all(), $rules, $messages);

        $shippers = new Shipper;
        $shippers->name = $request->name;
        $shippers->save();

        return response()->json($shippers, 200, [], 0);
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
        $shippers =  Shipper::find($id);
        return response($shippers);
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
        Validator::make($request->all(), $rules, $messages);

        $shippers = Shipper::find($id);
        $shippers->name = $request->name;
        $shippers->save();

        return response()->json($shippers, 200, [], 0);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Shipper::destroy($id);
        return response()->json([], 200, [], 0);
    }
}
