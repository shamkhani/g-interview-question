<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'panel', 'namespace' => 'Panel','middleware'=>'auth'], function ($router) {
    $router->get('/', function() {
        return view('panel.home');
    })->name('panel.home')->middleware('auth');
    $router->resource('news','NewsController');
//     Route::apiResource('news/categories','NewsCategoryController');
//     Route::apiResource('news/tags','TagController');
});



