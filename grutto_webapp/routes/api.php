<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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




