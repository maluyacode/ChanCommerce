<?php

namespace App\Http\Controllers;


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\facades\DB;

use App\Models\Orderline;
use App\Models\Shipper;
use App\Models\PaymentMethod;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Stock;
use App\Mail\OrderConfirmation;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function addcart($id)
    {
        dd($id);
        if (Auth::id()) {
            // dd($id);
            $user = auth()->user()->id;
            $cart = Cart::where('user_id', $user)
                ->where('item_id', $id)->first();
            // dd($cart);

            if ($cart) {
                $items = Item::find($id);
                Cart::where('user_id', $user)
                    ->where('item_id', $id)
                    ->update([
                        "quantityC" => $cart->quantityC + 1,
                        "sellprice" => $cart->sellprice + $items->sellprice
                    ]);

                return redirect()->back()->with('message', 'Product Added to Cart!');
            } else {
                $user = auth()->user();
                $items = Item::find($id);
                $cart = new Cart;

                $cart->user_id = $user->id;
                $cart->item_id = $items->id;
                $cart->quantityC = $cart->quantityC + 1;
                $cart->sellprice = $items->sellprice;
                $cart->save();
                // dd($cart);
                return redirect()->back()->with('message', 'Product Added to Cart!');
            }
        } else {
            return redirect('login');
        }
    }
    public function shoppingcart($id)
    {
        $user = auth()->user()->id;
        $totalprice = 0;
        $shipper = Shipper::all();
        $pmethod = PaymentMethod::all();
        $cart = DB::table('carts')
            ->join('users', 'users.id', "=", 'carts.user_id')
            ->join('items', 'items.id', "=", 'carts.item_id')
            ->select('carts.*', 'items.img_path', 'items.item_name')
            ->where('user_id', $id)
            ->get();

        foreach ($cart as $carts) {
            $totalprice += $carts->sellprice;
        }

        return View::make('transact.shopping-cart', compact('cart', 'totalprice', 'shipper', 'pmethod', 'user'));
    }
    public function increment($id)
    {
        $user = auth()->user()->id;
        $cart = cart::where('user_id', $user)
            ->where('item_id', $id)->first();
        $items = Item::find($id);
        cart::where('user_id', $user)
            ->where('item_id', $id)
            ->update([
                "quantityC" => $cart->quantityC + 1,
                "sellprice" => $cart->sellprice + $items->sellprice
            ]);

        return back()->with('message', 'Cart Item Added');
    }
    public function decrement($id)
    {
        $user = auth()->user()->id;
        $cart = cart::where('user_id', $user)
            ->where('item_id', $id)->first();
        $items = Item::find($id);

        if ($cart->quantityC > 1) {
            cart::where('user_id', $user)
                ->where('item_id', $id)
                ->update([
                    "quantityC" => $cart->quantityC - 1,
                    "sellprice" => $cart->sellprice - $items->sellprice
                ]);
        }

        return back()->with('message', 'Cart Item Reduced');
    }

    public function deletecart($id)
    {
        $user = auth()->user()->id;
        cart::where('user_id', $user)
            ->where('item_id', $id)->delete();
        return back()->with('message', 'Cart Item Deleted');
    }

    public function checkout(Request $request, $id)
    {

        // $rules = [
        //     'pm_id' => 'required',
        //     'ship_id' => 'required',
        // ];

        // $messages = [
        //     'pm_id.required' => 'Payment Method is required',
        //     'ship_id.required' => 'Shipping Courier is required',
        // ];
        // $validator = Validator::make($request->all(), $rules, $messages);

        // if ($validator->fails()) {
        //     return redirect()
        //         ->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        $pmethod_id = $request->input('pmethod_id');

        // Check if a payment method has been selected
        if ($pmethod_id == "Select Payment Method") {
            // Redirect back with an error message
            return redirect()->back()->with('message', 'Please select a payment method.');
        }

        // Get the selected shipper ID
        $shipper_id = $request->input('shipper_id');
        if ($shipper_id == "Select Shipper") {
            // Redirect back with an error message
            return redirect()->back()->with('message', 'Please select a shipping courier.');
        }


        $user = auth()->user()->id;

        $userEmail = auth()->user()->email;
        $Email = "0christianquintero7@gmail.com";

        $cart = DB::table('carts')
            ->join('users', 'users.id', "=", 'carts.user_id')
            ->join('items', 'items.id', "=", 'carts.item_id')
            ->join('customers', 'customers.user_id', "=", 'carts.user_id')
            ->select('carts.*', 'customers.*')
            ->where('carts.user_id', $user)->get();
        //  dd($cart);

        $order = new Order;
        $ship = $request->shipper_id;
        $pm = $request->pmethod_id;
        $customer =  Customer::where('user_id', Auth::id())->first();

        $order->cus_id = $customer->id;
        $order->ship_id = $ship;
        $order->pm_id = $pm;
        $order->save();
        foreach ($cart as $carts) {

            DB::table('orderlines')->insert(
                [
                    'orderinfo_id' => $order->id,
                    'item_id' => $carts->item_id,
                    'quantity' => $carts->quantityC
                ]
            );


            $stock = Stock::find($carts->item_id);
            $stock->quantity = $stock->quantity - $carts->quantityC;
            if ($stock->quantity == 0) {
                Item::where('id', $carts->item_id)
                    ->update([
                        "description" => "Out of Stock",

                    ]);
            }
            $stock->save();
        }


        // Send the email with the PDF file

        Mail::send(new OrderMail($Email, $order));

        Cart::where('user_id', $user)->delete();


        return View::make('transact.success');
    }
}
