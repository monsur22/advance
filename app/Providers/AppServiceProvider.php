<?php

namespace App\Providers;

use App\Facades\Invoice;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind('Invoice',function($app){
        //     return new Invoice();
        // });
        App::bind('Invoice',function() {
            return new Invoice;
         });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
