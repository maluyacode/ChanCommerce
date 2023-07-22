<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $users = User::all();


        $customers = DB::table('customers')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->select('customers.*', 'customers.id AS cus_id', 'users.*')
            ->where('customers.user_id', Auth::id())->first();


        //return dd($customers);
        return View::make('auth.profile', compact('users', 'customers'));
        // return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
