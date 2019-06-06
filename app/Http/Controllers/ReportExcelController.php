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

class ReportExcelController extends Controller
{
	public function index()
    {
    	$articulos = \DB::table('sisme.article_histories')
                ->join('sisme.articles as art', 'sisme.article_histories.article_id', '=', 'art.id')
                ->join('sisme.categories as cat', 'art.category_id', '=', 'cat.id')
                ->join('sisme.article_income_items as ing', 'sisme.article_histories.article_income_item_id', '=', 'ing.id')
                ->join('sisme.units as uni', 'art.unit_id', '=', 'uni.id')
                ->leftjoin('sisme.article_request_items as sali', 'ing.article_income_id', '=', 'sali.article_request_id')
                ->select('art.code as codigo','art.name as detalle', 'cat.name as categoria','ing.cost as ingcost', 'uni.name as unidad', 'ing.quantity as ingcant', 'sali.quantity_apro as salcant')
                ->where('article_histories.type', 'Entrada')
                
                ->get();
        //echo $articulos;
        return view('reportExcel.index');
    }

      public function rptInventarioExcel()
    {
    	$user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
        $usr =collect($user);
    	$articulos = Stock::where('storage_id',Auth::user()->getStorage()->id)->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))->groupBy('stocks.article_id')->get();
		Excel::create('New file', function($excel)  use ($articulos) {
		    $excel->sheet('New sheet', function($sheet)  use (&$articulos){
		    $sheet->loadView('reportExcel.rptInventario');

		    $articulos = Stock::where('storage_id',Auth::user()->getStorage()->id)->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))->groupBy('stocks.article_id')->get();

		    // $sheet->row(7, function($row) {
      //               $row->setBackground('#186BBA');    
      //               $row->setBackground('#186BBA'); 
      //           });

			$total = count($articulos) + 8 ;
			$totalsum = Stock::select(DB::raw("SUM(quantity) as totcant"))->first();
			$sheet->mergeCells('A'.$total.':C'.$total.'');
			$sheet->row($total, function ($row) {
			$row->setFontFamily('Arial');
			$row->setFontSize(10);
			$row->setAlignment('center');
			$row->setFontWeight('bold');
			});

			$sheet->appendRow($total, array(
			    'TOTAL','','',''.$totalsum['totcant'].''
			));


		    });

		})->export('xls');
    }

     public function rptResumidoExcel()
    {
    	$user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
        $usr =collect($user);
    	$articulos = Stock::where('storage_id',Auth::user()->getStorage()->id)->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))->groupBy('stocks.article_id')->get();
		Excel::create('rptResumen', function($excel)  use ($articulos) {
		    $excel->sheet('New sheet', function($sheet)  use (&$articulos){
		        $sheet->loadView('reportExcel.rptResumido');
		    });
		})->export('xls');
    }

    public function rptMensualExcel()
    {
        $user= DB::table('public._bp_personas')
                ->where('prs_id','=',Auth::user()->usr_prs_id)
                ->first();
        $usr =collect($user);
        $articulos = Stock::where('storage_id',Auth::user()->getStorage()->id)->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))->groupBy('stocks.article_id')->get();
        Excel::create('rptResumen', function($excel)  use ($articulos) {
            $excel->sheet('New sheet', function($sheet)  use (&$articulos){
                $sheet->loadView('reportExcel.rptMensual');
            });
        })->export('xls');
    }

    public function listalmacenes()
    {
         $data = Storage::select('id', 'name')
            // ->where('tipfr_estado', 'A')
            ->get();
        return view('reportExcel.rptalmacen', compact('data'));
    }

    public function listalmacenes1($id)
    {
        $almacen = ArticleIncome::join('sisme.storages as sto', 'sisme.article_incomes.storage_id','=','sto.id')
                                ->join('sisme.article_income_items as item', 'sisme.article_incomes.id', '=', 'item.article_income_id')
                                ->join('sisme.articles as art', 'item.article_id', '=', 'art.id')
                                ->select('sto.name as almacen', 'article_incomes.id as num', 'art.code as codigo', 'art.name as articulo', 'item.quantity as cantidad', 'item.cost as costo')
                                ->where('article_incomes.storage_id',$id)
                                ->get();
        return Datatables::of($almacen)
        ->make(true);
    }
    public function listalmacenesSal()
    {
         $data = Storage::select('id', 'name')
            // ->where('tipfr_estado', 'A')
            ->get();
        return view('reportExcel.rptalmacenSalida', compact('data'));
    }

    public function listalmacenesSal1($id)
    {
        $almacen = ArticleRequest::join('sisme.storages as sto', 'sisme.article_requests.storage_origin_id','=','sto.id')
                                ->join('sisme.article_request_items as item', 'sisme.article_requests.id', '=', 'item.article_request_id')
                                ->join('sisme.articles as art', 'item.article_id', '=', 'art.id')
                                ->select('sto.name as almacen', 'article_requests.id as num', 'art.code as codigo', 'art.name as articulo', 'item.quantity as cantidad', 'item.quantity_apro as cantapro')
                                ->where('article_requests.storage_origin_id',$id)
                                ->get();
        return Datatables::of($almacen)
        ->make(true);
    }

}
