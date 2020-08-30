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

 Route::group(['prefix' => 'panel', 'namespace' => 'Panel','middleware'=>'auth'], function ($router) {

    $router->get('/', function() {
        return view('panel.home');
    })->name('panel.home')->middleware(['custom-cache']);
    $router->get('news/category/{cid}/{slug}','NewsController@getNewsByCategoryId');

    $router->resource('news/categories','NewsCategoryController');
    $router->resource('news','NewsController');

});



Route::group(['namespace' => 'API'], function ($router) {
    Route::group(['prefix' => 'v1','namespace' => 'V1'], function ($router) {
        $router->get('news/categories', "NewsCategoryController@index");
        $router->delete('news/categories/{id}', "NewsCategoryController@destroy");
        $router->delete('news/categories', "NewsCategoryController@destroyByIds");

        $router->get('news', "NewsController@index");
        $router->get('news/{news}', "NewsController@getNewsItem");
        $router->delete('news/{news}', "NewsController@destroy");
        $router->delete('news/', "NewsController@destroyByIds");
        $router->get('news/category/{cid}/{slug}', "NewsController@getNewsByCategoryId")->name('news.by.category');

    });
});

