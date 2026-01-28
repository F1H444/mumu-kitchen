<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Keranjang;

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
        Paginator::useBootstrapFive();
        view()->composer('*', function () {
            if (isset(auth()->user()->id)) {
                View::share('keranjangs', Keranjang::where('user_id', auth()->user()->id)->get());
            } else {
                View::share('keranjangs', collect([]));
            }
        });
    }
}
