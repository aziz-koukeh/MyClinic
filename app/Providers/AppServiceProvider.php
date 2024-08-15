<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind('path.public',function(){
        //     return base_path('public_html');
        // });
        // register_shutdown_function(function () {
        //     $logout=User::where('id',auth()->user()->id)->first();
        //     $logout->a_d = 0;
        //     $logout->save();
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
