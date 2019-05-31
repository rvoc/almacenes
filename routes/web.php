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



Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('provider', 'ProviderController');
    Route::resource('unit', 'UnitController');
    Route::resource('category', 'CategoryController');
    Route::resource('budge_item', 'BudgeItemController');
    Route::resource('storage', 'StorageController');
    Route::resource('article', 'ArticleController');
    Route::resource('income', 'IncomeController');
    Route::resource('stock', 'StockController');
    Route::resource('request', 'RequestController');

    Route::resource('print', 'ReportController');
    //route person
    Route::get('request_person','RequestController@index_person');
    Route::get('request_storage','RequestController@index_storage');
    Route::get('request_storage_done','RequestController@index_storage_done');
    Route::post('request/confirm_request','RequestController@confirmRequest');
    Route::post('request/delivery_request','RequestController@delivery');

    //manejo de transferencia entre almacenes
    Route::get('transfer_request','RequestController@transfer');
    Route::get('transfer_request_create','RequestController@create_transfer');
    Route::post('transfer_request_store','RequestController@store_transfer_confirm');
    Route::get('transfer_request_check/{article_request_id}','RequestController@check_transfer');


    Route::get('articles/{storage_id}','ArticleController@storage_article');

    //cambiar de sucursal
    Route::post('change_storage','UserController@changeStore');

    //listado para transferencia entre almacenes
    Route::get('storage_articles/{storage_id}','RequestController@storageArticles');

    Route::get('articles/{storage_id}','ArticleController@storage_article');

    //array data from model

    Route::get('list_categories','CategoryController@getData');
    Route::get('list_units','UnitController@getData');
    Route::get('list_budget_items','BudgeItemController@getData');
    Route::get('list_providers','ProviderController@getData');
    Route::get('list_storages','StorageController@getData');

    //reportes

    Route::get('income_note/{article_income_id}','ReportController@income_note');
    Route::get('request_note/{article_request_id}','ReportController@request_note');
    Route::get('out_note/{article_request_id}','ReportController@out_note');
    Route::get('minute_note/{article_request_id}','ReportController@minute_note');
    Route::get('kardex_fisico/{article_id}','ReportController@kardex_fisico');
    Route::get('kardex_valorado/{article_id}','ReportController@kardex_valorado');



});

