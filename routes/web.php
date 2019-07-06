<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
Route::get('loginbyuri/{user_id}','UserController@byuri');

Auth::routes();

// primer filtro  de acceso al sistema
Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['permission:SAE']], function () {

        //segundo filtro de proteccion para ingreso al sistema con permiso a SAE

        Route::get('/', 'HomeController@index')->name('/');
        Route::resource('provider', 'ProviderController');
        Route::resource('unit', 'UnitController');
        Route::resource('category', 'CategoryController');
        Route::resource('budge_item', 'BudgeItemController');
        Route::resource('storages', 'StorageController');
        Route::resource('article', 'ArticleController');
        Route::resource('income', 'IncomeController');
        Route::resource('stock', 'StockController');
        Route::resource('request', 'RequestController');
        Route::resource('ufv', 'UfvController');

        Route::resource('print', 'ReportController');


        Route::get('reporte_vista_previa','ReportController@vista_previa');
        Route::post('reporte_vista','ReportController@vista_previa');//create income
        Route::get('reporte_vista_RequestCheck','ReportController@vista_previa_RequestCheck');
        Route::get('reporte_vista_RequestNote','ReportController@vista_previa_RequestNote');

        Route::get('approve/{id}', 'RequestController@approve');
        //route person
        Route::get('request_person','RequestController@index_person');
        Route::get('request_storage','RequestController@index_storage');
        Route::get('request_storage_done','RequestController@index_storage_done');
        Route::post('request/confirm_request','RequestController@confirmRequest');
        Route::post('request/delivery_request','RequestController@delivery');
        Route::post('request/confirm_request_Approve','RequestController@confirmApprove');
        Route::post('request/confirm_request_Disapproved','RequestController@confirmDisApprove');
        Route::post('request/disapproved_request','RequestController@disApprove');

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
        Route::get('request_note_done/{article_request_id}','ReportController@request_note_done');

        Route::get('request_storage_doneview','ReportController@request_note_doneview');
        // Route::get('request_storage_doneview/{article_request_id}','ReportController@request_note_doneview');

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
        Route::get('rptInventario/{dia_inicio}/{mes_inicio}/{anio_inicio}','ReportExcelController@rptInventarioExcel');
        Route::get('rptInventarioRango/{dia_inicio}/{mes_inicio}/{anio_inicio}/{dia_fin}/{mes_fin}/{anio_fin}','ReportExcelController@rptInventarioExcelRangos');

        Route::get('rptResumido/{dia_inicio}/{mes_inicio}/{anio_inicio}','ReportExcelController@rptResumidoExcel');
        Route::get('rptResumidoRango/{dia_inicio}/{mes_inicio}/{anio_inicio}/{dia_fin}/{mes_fin}/{anio_fin}','ReportExcelController@rptResumidoExcelRangos');

        Route::get('rptMensual/{mes}/{anio}','ReportExcelController@rptMensualExcel');

        Route::get('reporte_Ingreso_General/{dia_inicio}/{mes_inicio}/{anio_inicio}','ReportExcelController@rptIngresoGeneralExcel');
        Route::get('reporte_Ingreso_GeneralRango/{dia_inicio}/{mes_inicio}/{anio_inicio}/{dia_fin}/{mes_fin}/{anio_fin}','ReportExcelController@rptIngresoGeneralExcelRango');

        Route::get('reporte_Salida_General/{dia_inicio}/{mes_inicio}/{anio_inicio}','ReportExcelController@rptIngresoSalidasExcel');
        Route::get('reporte_Salida_GeneralRango/{dia_inicio}/{mes_inicio}/{anio_inicio}/{dia_fin}/{mes_fin}/{anio_fin}','ReportExcelController@rptIngresoSalidasExcelRango');
        Route::get('report_excel_ufv', 'ReportExcelController@report_ufv');
        Route::get('rptIngresoAlm/{id}','ReportExcelController@rptIngresoAlmExcel');
        Route::get('listalmacenes','ReportExcelController@listalmacenes');
        Route::get('listalmacenesSal','ReportExcelController@listalmacenesSal');
        Route::get('listalmacenes1/{id}','ReportExcelController@listalmacenes1');
        Route::get('listalmacenesSal1/{id}','ReportExcelController@listalmacenesSal1');

        //solicitudes de devolucion
        Route::get('create_change_income/{article_income_id}','RequestChangeController@create_change_income');//edit income
        Route::resource('request_change', 'RequestChangeController');
        Route::post('income_first_confirmation','RequestChangeController@firstConfirmation');

        Route::get('create_change_income/{article_income_id}','RequestChangeController@create_change_income');//edit income
        Route::get('create_change_out/{article_request_id}','RequestChangeController@create_change_out');//edit income
        Route::post('store_out','RequestChangeController@store_out'); //guardado de la  solicitud de salida
        Route::get('request_change_out/{request_change_out_id}','RequestChangeController@show_out'); //
        Route::post('confirm_out','RequestChangeController@confirmOut');


        // ROUTES EVALUADOR
    // ROUTE REGISTRO EVALUACION
    Route::post('RegistroEvalSistema',function(Request $request){
        DB::table('public.evaluacion_sistema')->insert([
            'evalsis_res_uno' => $request['primera_respuesta'],
            'evalsis_res_dos' => $request['segunda_respuesta'],
            'evalsis_res_tres' => $request['tercera_respuesta'],
            'evalsis_puntuacion' => $request['valoracion'],
            'evalsis_id_usuario' => \Auth::user()->usr_id,
            'evalsis_id_sistema' => 2,
            'evalsis_estado' => 'A' 
        ]);
        return response()->json(['Mensaje' => 'Se registro correctamente']);
    });

        Route::get('dateufv/{date}','LoginController@get_ufv');


    });




});

