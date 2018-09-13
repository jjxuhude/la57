<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\BladeController;
use App\Http\Controllers\Frontend\RequestController;
use App\Http\Controllers\Frontend\DbController;


/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

// 前台
Route::group([
    'namespace' => 'Frontend'
], function () {
    
    Route::get('/', function () {
        return view('frontend.welcome');
    });
    Auth::routes();
    Route::get('home', 'HomeController@index');
    
    $routeConfig = resolve('routeConfig');
    $routeConfig->setController(BladeController::class);
    $routeConfig->setController(RequestController::class);
    $routeConfig->setController(DbController::class);
});


//后台

Route::group([
    'prefix'=>config('app.backend_prefix'),
    'namespace'=>'Backend'
], function () {
    $prefix = config('app.backend_prefix');
    Route::get('/',function () use ($prefix){
       return  redirect($prefix.'/login');
    });
    Route::get('/home', 'HomeController@index');
    Route::get('login', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');
});
