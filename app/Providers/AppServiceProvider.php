<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::composer('layouts.transact', function ($view) {
            $itemCount = 0;
        
            if (Auth::check()) {
                $userId = Auth::user()->id;
                $itemCount = DB::table('carts')->where('user_id', $userId)->count();
            }
        
            $view->with('itemCount', $itemCount);
        });
    }
}
