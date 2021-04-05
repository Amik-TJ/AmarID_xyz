<?php

namespace App\Providers;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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


        Blade::if('user', function () {
            return (auth()->check() && auth()->user()->admin == 0 && auth()->user()->print_vendor == 0 && auth()->user()->delivery_vendor == 0);
        });


        schema::defaultStringLength(191);
    }
}
