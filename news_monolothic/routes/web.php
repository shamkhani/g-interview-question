<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
$router->get('/', function() {
    return view('welcome');
})->name('home');

 Route::group(['prefix' => 'panel', 'namespace' => 'Panel','middleware'=>'auth'], function ($router) {

    $router->get('/', function() {
        return view('panel.home');
    })->name('panel.home')->middleware(['custom-cache']);
    $router->get('news/category/{cid}/{slug}','NewsController@getNewsByCategoryId');

    $router->resource('news/categories','NewsCategoryController');
    $router->resource('news','NewsController');

});


