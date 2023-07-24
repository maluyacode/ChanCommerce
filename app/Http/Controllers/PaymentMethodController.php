<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PaymentMethod::all();
        return response()->json($data, 200, [], 0);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('paymentmethods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'Methods' => 'required|max:255|min:3',
        ];
        $messages = [
            'Methods.required' => 'Please enter your Method name.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        $pmethods = new PaymentMethod;
        $pmethods->Methods = $request->name;
        $pmethods->save();

        return response()->json($pmethods, 200, [], 0);
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
        $pmethods =  PaymentMethod::find($id);
        return response()->json($pmethods, 200, [], 0);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'Methods' => 'required|max:255|min:3',
        ];
        $messages = [
            'Methods.required' => 'Please enter your Method name.',

        ];
        Validator::make($request->all(), $rules, $messages);

        $pmethods = PaymentMethod::find($id);
        $pmethods->Methods = $request->name;
        $pmethods->save();

        return response()->json($pmethods, 200, [], 0);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        PaymentMethod::destroy($id);
        return response()->json([], 200, [], 0);
    }
}
