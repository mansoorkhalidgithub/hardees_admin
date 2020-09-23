<?php

namespace App\Providers;

use App\Http\view\composers\OrderComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('partials.orders.*', OrderComposer::class);
    }
}
