<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('provider', 'ProviderController');
    Route::resource('unit', 'UnitController');
    Route::resource('category', 'CategoryController');
    Route::resource('budge_item', 'BudgeItemController');
    Route::resource('storage', 'StorageController');
    Route::resource('article', 'ArticleController');

    Route::get('articles/{storage_id}','ArticleController@storage_article');

    //array data from model

    Route::get('list_categories','CategoryController@getData');
    Route::get('list_units','UnitController@getData');
    Route::get('list_budget_items','BudgeItemController@getData');
    Route::get('list_providers','ProviderController@getData');




});

