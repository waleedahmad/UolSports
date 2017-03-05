<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('roll_no', function ($attribute, $value, $parameters, $validator) {
            return strtolower(substr($value, 0,3)) == 'bcs' || strtolower(substr($value, 0,3)) == 'mcs';
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
