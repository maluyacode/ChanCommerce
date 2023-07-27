<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        try {
            $adminUser = Customer::with('user')->where('user_id', Auth::user()->id)->first();
            $adminUser->getMedia('images');
        } catch (Exception $e) {
            return redirect()->route('backadmin')->with('error', 'Error occurred while fetching media.');
        }
        return View::make('auth.profile', compact('adminUser'));
    }

    // public function update(ProfileUpdateRequest $request)
    // {
    //     if ($request->password) {
    //         auth()->user()->update(['password' => Hash::make($request->password)]);
    //     }

    //     auth()->user()->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //     ]);

    //     return redirect()->back()->with('success', 'Profile updated.');
    // }
}
