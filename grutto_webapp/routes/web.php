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
    })->name('panel.home')->middleware(['auth','custom-cache']);


    $router->resource('news/categories','NewsCategoryController');

    $router->resource('news','NewsController');
    $router->get('news/category/{cid}/{slug}','NewsController@getNewsByCategoryId');
});



