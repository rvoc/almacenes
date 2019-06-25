<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\ArticleHistory;
use App\Article;
use App\ArticleIncome;
use App\ArticleRequest;
use App\User;
use App\Stock;
use App\Storage;
use Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Log;

class ReportExcelController extends Controller
{
	public function index()
    {
    	$articulos = \DB::table('sisme.article_histories')
                ->join('sisme.articles as art', 'sisme.article_histories.article_id', '=', 'art.id')
                ->join('sisme.categories as cat', 'art.category_id', '=', 'cat.id')
                ->join('sisme.article_income_items as ing', 'sisme.article_histories.article_income_item_id', '=', 'ing.id')
                ->join('sisme.units as uni', 'art.unit_id', '=', 'uni.id')
                //->join('')
                ->leftjoin('sisme.article_request_items as sali', 'sisme.article_histories.article_request_item_id', '=', 'sali.id')
                ->select('art.code as codigo','art.name as detalle', 'cat.name as categoria','ing.cost as ingcost', 'uni.name as unidad', 'ing.quantity as ingcant', 'article_histories.article_income_item_id',DB::raw('sum(article_histories.quantity_desc) as quantity'))
                ->groupBy('article_histories.article_income_item_id', 'codigo', 'detalle', 'categoria', 'ingcost', 'unidad', 'ingcant')
                //->where('article_histories.type', 'Entrada')
                ->get();
       // echo $articulos;
       return view('reportExcel.index');
    }

      public function rptInventarioExcel($dia)
    {
         //return $dia;
    	$user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
                // $user1= DB::table('public._bp_personas')
                // ->where('prs_id','=',Auth::user()->usr_prs_id)
                // ->first();
        $date=$dia;
         // return $date;
        $articulos = \DB::table('sisme.stocks')
                ->join('sisme.articles as art', 'sisme.stocks.article_id', '=', 'art.id')
                ->join('sisme.units as uni', 'art.unit_id', '=', 'uni.id')
                ->join('sisme.categories as cat', 'art.category_id', '=', 'cat.id')
                ->select('art.code as codigo','art.name as detalle', 'uni.name as unidad', 'cat.name as categoria', 'stocks.article_id',DB::raw('sum(stocks.quantity) as quantity'))
                ->where(DB::raw('cast(stocks.created_at as date)'),'=',$dia)
                ->groupBy('stocks.article_id', 'codigo', 'detalle', 'unidad', 'categoria')
                ->get();
         // return $articulos;
        // $user= DB::table('public._bp_personas')
        //         ->where('prs_id','=',Auth::user()->usr_prs_id)
        //         ->first();
// $date=date('Y-m-d')
    	// $articulos = Stock::where('storage_id',Auth::user()->getStorage()->id)->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))->groupBy('stocks.article_id')->get();
    	// return $articulos;
		Excel::create('rptInventario', function($excel)  use ($articulos, $date, $user) {
		    $excel->sheet('rptInventario', function($sheet)  use ($articulos, $date, $user){
		    $sheet->loadView('reportExcel.rptInventario',  array('articulos'=>$articulos), array('date'=>$date), array('user'=>$user));
		    });

		})->export('xls');
    }

     public function rptResumidoExcel($resdia)
    {
    	$user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
        $usr =collect($user);
        $date=$resdia;
        $articulos = \DB::table('sisme.stocks')
                ->join('sisme.articles as art', 'sisme.stocks.article_id', '=', 'art.id')
                ->join('sisme.units as uni', 'art.unit_id', '=', 'uni.id')
                ->join('sisme.categories as cat', 'art.category_id', '=', 'cat.id')
                ->select('art.code as codigo','art.name as detalle', 'uni.name as unidad', 'cat.name as categoria', 'stocks.article_id',DB::raw('sum(stocks.quantity) as quantity'))
                ->where(DB::raw('cast(stocks.created_at as date)'),'=',$resdia)
                ->groupBy('stocks.article_id', 'codigo', 'detalle', 'unidad', 'categoria')
                ->get();
        // return $articulos;

		Excel::create('rptResumen', function($excel)  use ($articulos, $date) {
		    $excel->sheet('New sheet', function($sheet)  use (&$articulos, $date){
		        $sheet->loadView('reportExcel.rptResumido', array('articulos'=>$articulos), array('date'=>$date));
		    });

		})->export('xls');
    }

       public function rptIngresoAlmExcel()
    {
        $user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
        $usr =collect($user);
        $articulos = Stock::where('storage_id',Auth::user()->getStorage()->id)->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))->groupBy('stocks.article_id')->get();
        Excel::create('rptMensual', function($excel)  use ($articulos) {
            $excel->sheet('New sheet', function($sheet)  use (&$articulos){
                $sheet->loadView('reportExcel.rptMensual');
            });
        })->export('xls');
    }

    // public function rptIngresoAlmExcel()
    // {
    //     $user= DB::table('public._bp_personas')
    //             ->where('prs_id','=',Auth::user()->usr_prs_id)
    //             ->first();
    //     $usr =collect($user);
    //     $articulos = Stock::where('storage_id',Auth::user()->getStorage()->id)->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))->groupBy('stocks.article_id')->get();
    //     Excel::create('rptMensual', function($excel)  use ($articulos) {
    //         $excel->sheet('New sheet', function($sheet)  use (&$articulos){
    //             $sheet->loadView('reportExcel.rptIngresoAlm');
    //         });
    //     })->export('xls');
    // }
    public function rptMensualExcel()
    {
        $user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
        $usr =collect($user);
        $articulos = Stock::where('storage_id',Auth::user()->getStorage()->id)->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))->groupBy('stocks.article_id')->get();
        Excel::create('rptMensual', function($excel)  use ($articulos) {
            $excel->sheet('New sheet', function($sheet)  use (&$articulos){
                $sheet->loadView('reportExcel.rptMensual');
            });
        })->export('xls');
    }

    public function rptIngresoGeneralExcel()
    {
        $user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
        $usr =collect($user);
        $ingresos = ArticleIncome::join('sisme.storages as sto', 'sisme.article_incomes.storage_id','=','sto.id')
                                ->join('sisme.article_income_items as item', 'sisme.article_incomes.id', '=', 'item.article_income_id')
                                ->join('sisme.articles as art', 'item.article_id', '=', 'art.id')
                                ->select('sto.name as almacen', 'article_incomes.id as num', 'art.code as codigo', 'art.name as articulo', 'item.quantity as cantidad', 'item.cost as costo')
                                ->where('article_incomes.storage_id',1)
                                ->get();
        Excel::create('rptGeneralIngreso', function($excel)  use ($ingresos) {
            $excel->sheet('rptGeneralIngreso', function($sheet)  use ($ingresos){
                $sheet->loadView('reportExcel.rptIngresoGeneral', array('ingresos'=>$ingresos));
            });
        })->export('xls');
    }

    public function rptIngresoSalidasExcel()
    {
        $user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
        $usr =collect($user);
        $salidas = ArticleRequest::join('sisme.storages as sto', 'sisme.article_requests.storage_origin_id','=','sto.id')
                                ->join('sisme.article_request_items as item', 'sisme.article_requests.id', '=', 'item.article_request_id')
                                ->join('sisme.articles as art', 'item.article_id', '=', 'art.id')
                                ->select('sto.name as almacen', 'article_requests.id as num', 'art.code as codigo', 'art.name as articulo', 'item.quantity as cantidad', 'item.quantity_apro as cantapro')
                                ->where('article_requests.storage_origin_id',1)
                                ->get();
        Excel::create('rptSalidaGeneral', function($excel)  use ($salidas) {
            $excel->sheet('rptSalidaGeneral', function($sheet)  use ($salidas){
                $sheet->loadView('reportExcel.rptSalidaGeneral', array('salidas'=>$salidas));
            });
        })->export('xls');
    }

    public function listalmacenes()
    {
        $data = Storage::select('id', 'name')->get();
        return view('reportExcel.rptalmacen', compact('data'));
    }

    public function listalmacenes1($id)
    {
        $almacenes = ArticleIncome::join('sisme.storages as sto', 'sisme.article_incomes.storage_id','=','sto.id')
                                ->join('sisme.article_income_items as item', 'sisme.article_incomes.id', '=', 'item.article_income_id')
                                ->join('sisme.articles as art', 'item.article_id', '=', 'art.id')
                                ->select('sto.name as almacen', 'article_incomes.id as num', 'art.code as codigo', 'art.name as articulo', 'item.quantity as cantidad', 'item.cost as costo')
                                ->where('article_incomes.storage_id',$id)
                                ->get();
         return response()->json($almacenes);                      
    }
    public function listalmacenesSal()
    {
         $data = Storage::select('id', 'name')->get();
        return view('reportExcel.rptalmacenSalida', compact('data'));
    }

    public function listalmacenesSal1($id)
    {
        $almacenes = ArticleRequest::join('sisme.storages as sto', 'sisme.article_requests.storage_origin_id','=','sto.id')
                                ->join('sisme.article_request_items as item', 'sisme.article_requests.id', '=', 'item.article_request_id')
                                ->join('sisme.articles as art', 'item.article_id', '=', 'art.id')
                                ->select('sto.name as almacen', 'article_requests.id as num', 'art.code as codigo', 'art.name as articulo', 'item.quantity as cantidad', 'item.quantity_apro as cantapro')
                                ->where('article_requests.storage_origin_id',$id)
                                ->get();
        return response()->json($almacenes);
    }

}
