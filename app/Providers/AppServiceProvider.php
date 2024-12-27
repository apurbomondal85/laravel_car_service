<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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

        Validator::extend('phone_number', function ($attribute, $value, $parameters) {
            $has_plus = substr($value, 0, 1) == '+';
            $mobile_arr = explode('-', $value);

            return $has_plus && count($mobile_arr) == 2 && is_numeric($mobile_arr[1]);
        });
    }
}
