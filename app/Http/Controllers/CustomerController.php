<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer;
use App\Models\User;
use App\Models\Order;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();


        $customers = DB::table('customers')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->select('customers.*', 'customers.id AS cus_id', 'users.*')

            ->orderBy('customers.id', 'ASC')->get();
        return View::make('customers.index', compact('users', 'customers'));
    }

    public function userprofile($id, Request $request)
    {
        $users = User::all();
        $user = Auth::user();

        $customers = DB::table('customers')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->select('customers.*', 'customers.id AS cus_id', 'users.*')
            ->where('customers.user_id', $id)->first();

        $totalprice = 0;
        $order = Order::find($id);
        $status = $request->input('status');
        if ($status === 'processing') {
            $orders = DB::table('orders')
                ->join('orderlines', 'orders.id', '=', 'orderlines.orderinfo_id')
                ->join('customers', 'orders.cus_id', '=', 'customers.id')
                ->join('items', 'items.id', '=', 'orderlines.item_id')
                ->join('shippers', 'orders.ship_id', '=', 'shippers.id')
                ->join('payment_methods', 'payment_methods.id', '=', 'orders.pm_id')
                ->select('orders.id AS o_id', 'orders.*', 'orderlines.*', 'items.*', 'shippers.*', 'payment_methods.*', 'customers.*')

                ->where('customers.user_id', $id)
                ->where('status', 'Processing')
                ->orderBy('orders.id', 'ASC')->paginate(10);

            foreach ($orders as $order) {
                $totalprice += $order->sellprice;
            }
        } elseif ($status === 'delivered') {
            $orders = DB::table('orders')
                ->join('orderlines', 'orders.id', '=', 'orderlines.orderinfo_id')
                ->join('customers', 'orders.cus_id', '=', 'customers.id')
                ->join('items', 'items.id', '=', 'orderlines.item_id')
                ->join('shippers', 'orders.ship_id', '=', 'shippers.id')
                ->join('payment_methods', 'payment_methods.id', '=', 'orders.pm_id')
                ->select('orders.id AS o_id', 'orders.*', 'orderlines.*', 'items.*', 'shippers.*', 'payment_methods.*', 'customers.*')

                ->where('customers.user_id', $id)
                ->where('status', 'Delivered')
                ->orderBy('orders.id', 'ASC')->paginate(10);

            foreach ($orders as $order) {
                $totalprice += $order->sellprice;
            }
        } elseif ($status === 'shipped') {
            $orders = DB::table('orders')
                ->join('orderlines', 'orders.id', '=', 'orderlines.orderinfo_id')
                ->join('customers', 'orders.cus_id', '=', 'customers.id')
                ->join('items', 'items.id', '=', 'orderlines.item_id')
                ->join('shippers', 'orders.ship_id', '=', 'shippers.id')
                ->join('payment_methods', 'payment_methods.id', '=', 'orders.pm_id')
                ->select('orders.id AS o_id', 'orders.*', 'orderlines.*', 'items.*', 'shippers.*', 'payment_methods.*', 'customers.*')

                ->where('customers.user_id', $id)
                ->where('status', 'Shipped')
                ->orderBy('orders.id', 'ASC')->paginate(10);

            foreach ($orders as $order) {
                $totalprice += $order->sellprice;
            }
        } elseif ($status === 'cancelled') {
            $orders = DB::table('orders')
                ->join('orderlines', 'orders.id', '=', 'orderlines.orderinfo_id')
                ->join('customers', 'orders.cus_id', '=', 'customers.id')
                ->join('items', 'items.id', '=', 'orderlines.item_id')
                ->join('shippers', 'orders.ship_id', '=', 'shippers.id')
                ->join('payment_methods', 'payment_methods.id', '=', 'orders.pm_id')
                ->select('orders.id AS o_id', 'orders.*', 'orderlines.*', 'items.*', 'shippers.*', 'payment_methods.*', 'customers.*')

                ->where('customers.user_id', $id)
                ->where('status', 'Cancelled')
                ->orderBy('orders.id', 'ASC')->paginate(10);

            foreach ($orders as $order) {
                $totalprice += $order->sellprice;
            }
        } elseif ($status === 'for delivery') {
            $orders = DB::table('orders')
                ->join('orderlines', 'orders.id', '=', 'orderlines.orderinfo_id')
                ->join('customers', 'orders.cus_id', '=', 'customers.id')
                ->join('items', 'items.id', '=', 'orderlines.item_id')
                ->join('shippers', 'orders.ship_id', '=', 'shippers.id')
                ->join('payment_methods', 'payment_methods.id', '=', 'orders.pm_id')
                ->select('orders.id AS o_id', 'orders.*', 'orderlines.*', 'items.*', 'shippers.*', 'payment_methods.*', 'customers.*')

                ->where('customers.user_id', $id)
                ->where('status', 'For Delivery')
                ->orderBy('orders.id', 'ASC')->paginate(10);

            foreach ($orders as $order) {
                $totalprice += $order->sellprice;
            }
        } else {
            $orders = DB::table('orders')
                ->join('orderlines', 'orders.id', '=', 'orderlines.orderinfo_id')
                ->join('customers', 'orders.cus_id', '=', 'customers.id')
                ->join('items', 'items.id', '=', 'orderlines.item_id')
                ->join('shippers', 'orders.ship_id', '=', 'shippers.id')
                ->join('payment_methods', 'payment_methods.id', '=', 'orders.pm_id')
                ->select('orders.id AS o_id', 'orders.*', 'orderlines.*', 'items.*', 'shippers.*', 'payment_methods.*', 'customers.*')

                ->where('customers.user_id', $id)
                ->orderBy('orders.id', 'ASC')->paginate(10);

            foreach ($orders as $order) {
                $totalprice += $order->sellprice;
            }
        }

        $itemCount = DB::table('carts')->where('user_id', Auth::user()->id)->count();
        return View::make('customers.cusprofile', compact('order', 'user', 'users', 'customers', 'totalprice', 'orders', 'itemCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('customers.create');
    }
    public function customerscreate()
    {
        return View::make('customers.usercreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'customer_name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'img_pathC' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages = [
            'customer_name.required' => 'Account Name is required',
            'contact.required' => 'Account Contact is required',
            'address.required' => 'Account Home Address is required',
            'img_pathC.required' => 'Account Image is required',
            'img_pathC.image' => 'Account Image must be an image',
            'img_pathC.mimes' => 'Account Image must be a file of type: jpeg, png, jpg, gif',
            'img_pathC.max' => 'Account Image must not be larger than 2048 kilobytes',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $customer = new Customer;

        if ($request->file()) {
            $fileName = time() . '_' . $request->file('img_pathC')->getClientOriginalName();

            $path = Storage::putFileAs(
                'public/images',
                $request->file('img_pathC'),
                $fileName
            );
            $customer->img_pathC = '/storage/images/' . $fileName;
        }

        $customer->customer_name = $request->customer_name;
        $customer->contact = $request->contact;
        $customer->address = $request->address;
        $customer->user_id = Auth::user()->id;

        $usertype = Auth::user()->usertype;
        $customer->save();

        return redirect()->route('customers.index');
    }
    public function userstore(Request $request)
    {
        $rules = [
            'customer_name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'img_pathC' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages = [
            'customer_name.required' => 'Account Name is required',
            'contact.required' => 'Account Contact is required',
            'address.required' => 'Account Home Address is required',
            'img_pathC.required' => 'Account Image is required',
            'img_pathC.image' => 'Account Image must be an image',
            'img_pathC.mimes' => 'Account Image must be a file of type: jpeg, png, jpg, gif',
            'img_pathC.max' => 'Account Image must not be larger than 2048 kilobytes',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $customer = new Customer;

        if ($request->file()) {
            $fileName = time() . '_' . $request->file('img_pathC')->getClientOriginalName();

            $path = Storage::putFileAs(
                'public/images',
                $request->file('img_pathC'),
                $fileName
            );
            $customer->img_pathC = '/storage/images/' . $fileName;
        }

        $customer->customer_name = $request->customer_name;
        $customer->contact = $request->contact;
        $customer->address = $request->address;
        $customer->user_id = Auth::user()->id;

        $usertype = Auth::user()->usertype;
        $customer->save();

        return redirect()->route('redirect');
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
        $customer =  Customer::find($id);
        return view('customers.edit', compact('customer'));
    }
    public function customersedit(string $id)
    {
        $customer = DB::table('customers')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->select('customers.*', 'customers.id AS cus_id', 'users.*')
            ->where('customers.user_id', $id)->first();
        return view('customers.useredit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function userupdate(Request $request)
    { {
            $rules = [
                'customer_name' => 'required',
                'contact' => 'required',
                'address' => 'required',
                'img_pathC' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];

            $messages = [
                'customer_name.required' => 'Account Name is required',
                'contact.required' => 'Account Contact is required',
                'address.required' => 'Account Home Address is required',
                'img_pathC.required' => 'Account Image is required',
                'img_pathC.image' => 'Account Image must be an image',
                'img_pathC.mimes' => 'Account Image must be a file of type: jpeg, png, jpg, gif',
                'img_pathC.max' => 'Account Image must not be larger than 2048 kilobytes',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $user = Auth::user()->id;
            $customer = Customer::where('user_id', $user)->first();


            if ($request->file()) {
                $fileName = time() . '_' . $request->file('img_pathC')->getClientOriginalName();


                $path = Storage::putFileAs(
                    'public/images',
                    $request->file('img_pathC'),
                    $fileName
                );
                $customer->img_pathC = '/storage/images/' . $fileName;
            }
            $customer->customer_name = $request->input('customer_name');
            $customer->contact = $request->input('contact');
            $customer->address = $request->input('address');


            $customer->save();

            $usertype = Auth::user()->usertype;
            if ($usertype == 'Admin') {
                return redirect()->route('customers.index');
            } else {
                return redirect()->route('redirect');
            }
        }
    }
    public function update(Request $request, string $id)
    {
        $rules = [
            'customer_name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'img_pathC' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $messages = [
            'customer_name.required' => 'Account Name is required',
            'contact.required' => 'Account Contact is required',
            'address.required' => 'Account Home Address is required',
            'img_pathC.required' => 'Account Image is required',
            'img_pathC.image' => 'Account Image must be an image',
            'img_pathC.mimes' => 'Account Image must be a file of type: jpeg, png, jpg, gif',
            'img_pathC.max' => 'Account Image must not be larger than 2048 kilobytes',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $usertype = Auth::user()->usertype;
        if ($usertype == 'Admin') {
            $customer = Customer::find($id);


            if ($request->file()) {
                $fileName = time() . '_' . $request->file('img_pathC')->getClientOriginalName();


                $path = Storage::putFileAs(
                    'public/images',
                    $request->file('img_pathC'),
                    $fileName
                );
                $customer->img_pathC = '/storage/images/' . $fileName;
            }
            $customer->customer_name = $request->customer_name;
            $customer->contact = $request->contact;
            $customer->address = $request->address;

            $customer->save();
        } else {
            $customer = Customer::where('user_id', Auth::user()->id);


            if ($request->file()) {
                $fileName = time() . '_' . $request->file('img_pathC')->getClientOriginalName();


                $path = Storage::putFileAs(
                    'public/images',
                    $request->file('img_pathC'),
                    $fileName
                );
                $customer->img_pathC = '/storage/images/' . $fileName;
            }
            $customer->customer_name = $request->customer_name;
            $customer->contact = $request->contact;
            $customer->address = $request->address;

            $customer->save();
        }
        if ($usertype == 'Admin') {
            return redirect()->route('customers.index');
        } else {
            return redirect()->route('redirect');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::destroy($id);
        return redirect()->route('customers.index');
    }

    public function Cancelled($id)
    {
        $order = DB::table('orders')
            ->join('orderlines', 'orders.id', '=', 'orderlines.orderinfo_id')
            ->join('customers', 'orders.cus_id', '=', 'customers.id')
            ->join('items', 'items.id', '=', 'orderlines.item_id')
            ->join('shippers', 'orders.ship_id', '=', 'shippers.id')
            ->join('payment_methods', 'payment_methods.id', '=', 'orders.pm_id')
            ->select('orders.id AS o_id', 'orders.*', 'orderlines.*', 'items.*', 'shippers.*', 'payment_methods.*', 'customers.*')
            ->where('orders.id', $id)
            ->first();
        if ($order->status == "Processing") {
            $orders = DB::table('orders')
                ->join('orderlines', 'orders.id', '=', 'orderlines.orderinfo_id')
                ->join('customers', 'orders.cus_id', '=', 'customers.id')
                ->join('items', 'items.id', '=', 'orderlines.item_id')
                ->join('shippers', 'orders.ship_id', '=', 'shippers.id')
                ->join('payment_methods', 'payment_methods.id', '=', 'orders.pm_id')
                ->select('orders.id AS o_id', 'orders.*', 'orderlines.*', 'items.*', 'shippers.*', 'payment_methods.*', 'customers.*')
                ->where('orders.id', $id)
                ->first();

            Order::where('id', $id)
                ->update([
                    "status" => "Cancelled"

                ]);

            return back();
        } else {
            return back()->with('message', 'Order Cannot Be Cancelled');
        }
    }
}
