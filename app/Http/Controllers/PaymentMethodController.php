<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
Use View;
Use Storage;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pmethods = PaymentMethod::all();
        
        return View::make('paymentmethods.index',compact('pmethods'));
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
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        $pmethods = new PaymentMethod;

      
        $pmethods->Methods = $request->Methods;
   
       
        $pmethods->save();
        return redirect()->route('paymentmethods.index');
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
        $pmethods =  PaymentMethod::find($id);
        return view('paymentmethods.edit', compact('pmethods'));
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
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $pmethods = PaymentMethod::find($id);

       
        $pmethods->Methods = $request->Methods;
       
       
        $pmethods->save();
        return redirect()->route('paymentmethods.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PaymentMethod::destroy($id);
        return redirect()->route('paymentmethods.index');
    }
}
