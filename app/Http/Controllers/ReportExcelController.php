<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\ArticleHistory;
use App\Article;
use App\User;
use App\Stock;
use App\Storage;
use Auth;
use Illuminate\Support\Facades\DB;

class ReportExcelController extends Controller
{
	public function index()
    {
    	$articulos = \DB::table('sisme.stocks')
                ->join('sisme.articles as art', 'sisme.stocks.article_id', '=', 'art.id')
                ->join('sisme.units as uni', 'art.unit_id', '=', 'uni.id')
                ->join('sisme.categories as cat', 'art.category_id', '=', 'cat.id')
                ->leftjoin('sisme.storages as alm', 'sisme.stocks.storage_id', '=', 'alm.id')
                ->select('art.code as codigo','art.name as detalle', 'uni.name as unidad', 'cat.name as categoria',  'alm.name as almacenes','stocks.article_id',DB::raw('sum(stocks.quantity) as quantity'))
                ->groupBy('stocks.article_id', 'codigo', 'detalle', 'unidad', 'categoria', 'almacenes')
                ->get();
        // echo $articulos;
        return view('reportExcel.index');
    }

      public function rptInventarioExcel()
    {
    	$user= DB::table('siscor._bp_personas')
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
    	$user= DB::table('siscor._bp_personas')
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

        public function listalmacenes()
    {
         $data = Storage::select('id', 'name')
            // ->where('tipfr_estado', 'A')
            ->get();
        return view('reportExcel.rptalmacen', compact('data'));
    }

    public function listalmacenes1($id)
    {
        $almacen = Stock::where('storage_id',Auth::user()->getStorage()->id)->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))->where('storage_id', $id)->groupBy('stocks.article_id')->get();
        return Datatables::of($almacen)
    //     ->addColumn('acciones', function ($sum) {
    //       return '<button value="' . $sum->prov_id1 . '" class="btn btn-primary" style="background:#F5B041" onClick="MostrarRegistro(this);" data-toggle="modal" data-target="#myCreate">REGISTRAR</button>
    //                <a href="Acopio/listarDetalle/' . $sum->prov_id1 . '" class="btn btn-primary" style="background:#5499C7">LISTAR</i></a>';   
  		// })
        ->make(true);
    }

}
