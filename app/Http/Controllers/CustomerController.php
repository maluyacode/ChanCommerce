<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Customer;
use App\Models\User;
use App\Models\Order;
use Barryvdh\Debugbar\Facades\Debugbar;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function storeMedia(Request $request)
    {
        $path = storage_path("customers/images");
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

    public function index()
    {
        $customers = Customer::with(['user', 'media'])->get();
        return response()->json($customers, 200, [], 0);
    }

    public function userprofile($id, Request $request)
    {
        $users = User::all();
        $user = Auth::user();
        $itemCount = DB::table('carts')->where('user_id', $id)->count();

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
        // dd($orders);

        $itemCount = DB::table('carts')->where('user_id', Auth::user()->id)->count();
        return View::make('customers.cusprofile', compact('order', 'user', 'users', 'customers', 'totalprice', 'orders', 'itemCount'));

        // return View::make('customers.cusprofile', compact('order', 'user', 'users', 'customers', 'totalprice', 'orders','itemCount'));
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
        Debugbar::info($request);
        $rules = [
            'customer_name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'password' => 'required',
            'email' => 'required',
        ];
        $messages = [
            'customer_name.required' => 'Account Name is required',
            'contact.required' => 'Account Contact is required',
            'address.required' => 'Account Home Address is required',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        $user = new User;
        $user->name = $request->customer_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->usertype = $request->usertype;
        $user->save();

        $customer = new Customer;
        $customer->customer_name = $request->customer_name;
        $customer->contact = $request->contact;
        $customer->address = $request->address;
        $customer->user_id = $user->id;
        $customer->img_pathC = "DEFAULT";

        if ($request->document !== null) {
            foreach ($request->input("document", []) as $file) {
                $customer->addMedia(storage_path("customers/images/" . $file))->toMediaCollection("images");
                // unlink(storage_path("drivers/images/" . $file));
            }
        }

        $customer->save();

        return response()->json($customer, 200, [], 0);
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
    public function edit($id)
    {
        $customer = Customer::with('user')->find($id);
        $customer->getMedia('images');
        return response()->json($customer);
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
    public function update(Request $request, $id)
    {
        Debugbar::info($request);
        $rules = [
            'customer_name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'email' => 'required',
        ];
        $messages = [
            'customer_name.required' => 'Account Name is required',
            'contact.required' => 'Account Contact is required',
            'address.required' => 'Account Home Address is required',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        $user = User::find($id);
        $user->name = $request->customer_name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->usertype = $request->usertype;
        $user->save();


        $customer = Customer::where('user_id', $id)->first();
        $customer->customer_name = $request->customer_name;
        $customer->contact = $request->contact;
        $customer->address = $request->address;
        $customer->user_id = $user->id;
        $customer->img_pathC = "DEFAULT";
        if ($request->document !== null) {
            DB::table('media')->where('model_id', $customer->id)->where('model_type', 'App\Models\Customer')->delete();
            foreach ($request->input("document", []) as $file) {
                $customer->addMedia(storage_path("customers/images/" . $file))->toMediaCollection("images");
                // unlink(storage_path("drivers/images/" . $file));
            }
        }
        $customer->save();

        return response()->json($customer, 200, [], 0);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Debugbar::info($id);
        $customer = Customer::find($id);
        User::destroy($customer->user_id);
        DB::table('media')->where('model_id', $id)->delete();
        return response()->json([], 200, [], 0);
    }

    public function Cancelled($id)
    {
        // dd($id);
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
    public function getCustomerMedia($id)
    {
        $customer = Customer::find($id);
        $customer->getMedia('images');
        return response()->json($customer);
    }
}
