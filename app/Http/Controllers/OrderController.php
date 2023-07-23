<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\OrderConfirmation;
use App\Mail\OrderMail;

use App\DataTables\DeliveredOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\ShippedOrderDataTable;
use App\Models\Orderline;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\Shipper;
use App\Models\PaymentMethod;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveredOrderDataTable $dataTable)
    {
        $orders = Order::with([
            'items' => function ($query) {
                return $query->select('id', 'item_name', 'sellprice');
            },
            'customer' => function ($query) {
                return $query->select('id', 'customer_name');
            },
            'shipper'  => function ($query) {
                return $query->select('id', 'name');
            },
            'paymentmethod'  => function ($query) {
                return $query->select('id', 'Methods');
            }
        ])->where('status', "Delivered")->get();

        $total = 0;
        foreach ($orders as $order) {
            $total += $order->items->map(function ($item) {
                return  $item->sellprice * $item->pivot->quantity;
            })->sum();
        }

        return $dataTable->render('orders.show', compact('total'));
    }


    public function getOrders()
    {
        // $total = 0;
        // $orders = DB::table('orders')
        //     ->join('customers', 'orders.cus_id', '=', 'customers.id')
        //     ->select('orders.id AS o_id', 'orders.created_at', 'orders.status', 'customers.*')
        //     ->where('orders.status', "Processing")
        //     ->orWhere('orders.status', "Shipped")
        //     ->orderBy('orders.id', 'ASC')->get();
        // foreach ($orders as $order) {
        //     $total = $total + 1;
        // }
        $orders = Order::with([
            'items' => function ($query) {
                return $query->select('id', 'item_name', 'sellprice');
            },
            'customer' => function ($query) {
                return $query->select('id', 'customer_name');
            },
            'shipper'  => function ($query) {
                return $query->select('id', 'name');
            },
            'paymentmethod'  => function ($query) {
                return $query->select('id', 'Methods');
            }
        ])->whereNotIn('status', ["Delivered"])->get();

        return response()->json($orders);
    }

    public function Delivered($id)
    {
        $order = Order::find($id);

        Order::where('id', $id)
            ->update([
                "status" => "Delivered"

            ]);

        return response()->json($order);
    }

    public function ForDelivery($id)
    {
        $orders = DB::table('orders')
            ->join('orderlines', 'orders.id', '=', 'orderlines.orderinfo_id')
            ->join('customers', 'orders.cus_id', '=', 'customers.id')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->join('items', 'items.id', '=', 'orderlines.item_id')
            ->join('shippers', 'orders.ship_id', '=', 'shippers.id')
            ->join('payment_methods', 'payment_methods.id', '=', 'orders.pm_id')
            ->select('orders.id AS o_id', 'orders.*', 'orderlines.*', 'items.*', 'shippers.*', 'payment_methods.*', 'customers.*', 'users.*')
            ->where('orders.id', $id)
            ->first();

        $order = Order::find($id);

        Order::where('id', $id)
            ->update([
                "status" => "For Delivery"

            ]);
        $userEmail = $orders->email;

        Mail::send(new OrderConfirmation($userEmail, $order));
        return View::make('transact.confirmed');
    }

    public function Shipped($id)
    {
        $order = Order::find($id);

        Order::where('id', $id)
            ->update([
                "status" => "Shipped"
            ]);

        return response()->json($order);
    }

    public function ShippedOrders(ShippedOrderDataTable $dataTable)
    {
        $test = 10;
        return $dataTable->render('orders.shipped', compact('test'));
    }
    /**
     * Show the form for editing the specified resource.
     */


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
