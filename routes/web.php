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

// primer filtro  de acceso al sistema
Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['permission:SAE']], function () {

        //segundo filtro de proteccion para ingreso al sistema con permiso a SAE

        Route::get('/', 'HomeController@index')->name('home');
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

        //manejo de Roles
        Route::get('get_permission_role/{role_id}','UserController@getPermissionRol');
        Route::post('store_role','UserController@storeRole');
        //reportes

        Route::get('income_note/{article_income_id}','ReportController@income_note');
        Route::get('request_note/{article_request_id}','ReportController@request_note');
        Route::get('out_note/{article_request_id}','ReportController@out_note');
        Route::get('minute_note/{article_request_id}','ReportController@minute_note');
        Route::get('kardex_fisico/{article_id}','ReportController@kardex_fisico');
        Route::get('kardex_valorado/{article_id}','ReportController@kardex_valorado');

        Route::group(['middleware' => ['role:Administrador','permission:SAE']], function ()
        {
            //
            Route::resource('user', 'UserController');
            Route::get('system','UserController@system');
            Route::post('store_system','UserController@storeSystem')->name('save_system');
        });

        //reportes Excel
        Route::resource('report_excel','ReportExcelController');
        Route::get('rptInventario','ReportExcelController@rptInventarioExcel');
        Route::get('rptResumido','ReportExcelController@rptResumidoExcel');
        Route::get('rptMensual','ReportExcelController@rptMensualExcel');
        Route::get('reporte_Ingreso_General','ReportExcelController@rptIngresoGeneralExcel');
        Route::get('reporte_Salida_General','ReportExcelController@rptIngresoSalidasExcel');

        Route::get('rptIngresoAlm/{id}','ReportExcelController@rptIngresoAlmExcel');
        Route::get('listalmacenes','ReportExcelController@listalmacenes');
        Route::get('listalmacenesSal','ReportExcelController@listalmacenesSal');
        Route::get('listalmacenes1/{id}','ReportExcelController@listalmacenes1');
        Route::get('listalmacenesSal1/{id}','ReportExcelController@listalmacenesSal1');

        //solicitudes de devolucion
        Route::get('create_change_income/{article_income_id}','RequestChangeController@create_change_income');
        Route::resource('request_change', 'RequestChangeController');

    });




});

