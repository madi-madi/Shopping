<?php

namespace App\Providers;
//use Illuminate\Http\Request;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Download;
use App\Invoice;
use Illuminate\Http\Request;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        //

       // View::share('cookie', $cookie);
             

                View::composer(
            'shop.download', 'App\Http\ViewComposers\InvoiceComposer'
        );

        /* View::composer('mail.mesgmail', function ($view) {
            //
            $view->with('invoices' ,$invoices);
        });*/
    
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
