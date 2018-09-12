<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        defined('DS') || define('DS',DIRECTORY_SEPARATOR );
        $prefix = config('app.backend_prefix');
        if(preg_match('/^\/'.$prefix.'/i', request()->getRequestUri(),$match)){
            include $this->app->basePath().DS.'app'.DS.'Lib'.DS.'backend.php';
        }else{
        }
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
