<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        $categories = Category::all();
        $suppliers = Supplier::all();

        $items = DB::table('items')
            ->join('categories', 'items.cat_id', '=', 'categories.id')
            ->join('suppliers', 'items.sup_id', '=', 'suppliers.id')
            ->select('items.id as it_id', 'items.*', 'categories.*', 'suppliers.*')
            ->orderBy('items.id', 'ASC')->get();

        if ($usertype == 'Admin') {
            return view('home');
        } else {
            return view('transact.dashboard', compact('usertype', 'categories', 'items', 'suppliers'));
        }
    }
    
    public function redirectadmin()
    {
        $usertype = Auth::user()->usertype;
        $categories = Category::all();
        $suppliers = Supplier::all();

        $items = DB::table('items')
            ->join('categories', 'items.cat_id', '=', 'categories.id')
            ->join('suppliers', 'items.sup_id', '=', 'suppliers.id')
            ->select('items.id as it_id', 'items.*', 'categories.*', 'suppliers.*')
            ->orderBy('items.id', 'ASC')->get();

        if ($usertype == 'Admin') {
            return view('transact.dashboard', compact('usertype', 'categories', 'items', 'suppliers'));
        } else {
            return view('transact.dashboard', compact('usertype', 'categories', 'items', 'suppliers'));
        }
    }
    public function backadmin()
    {
        $usertype = Auth::user()->usertype;
        $categories = Category::all();
        $suppliers = Supplier::all();
        $userId = auth()->user()->id;
        $itemCount = DB::table('carts')->where('user_id', $userId)->count();

        $items = DB::table('items')
            ->join('categories', 'items.cat_id', '=', 'categories.id')
            ->join('suppliers', 'items.sup_id', '=', 'suppliers.id')
            ->select('items.id as it_id', 'items.*', 'categories.*', 'suppliers.*')
            ->orderBy('items.id', 'ASC')->get();

        if ($usertype == 'Admin') {
            return view('home');
        } else {
            return view('transact.dashboard', compact('usertype', 'categories', 'items', 'suppliers', 'itemCount'));
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('redirect');
    }
}
