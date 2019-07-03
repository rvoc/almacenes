<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use App\Storage;
use App\Article;
use App\Provider;
use App\ArticleIncome;
use App\ArticleIncomeItem;
use App\ArticleRequest;
use App\ArticleRequestItem;
use App\Stock;
use App\User;
use App\Person;
use App\ArticleHistory;
use Illuminate\Support\Facades\DB;
use resource\js\components\IncomeCreate;
use Log;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $username = Auth::user()->usr_usuario;
        $title = "Reporte ";
        $date =Carbon::now();
        $storage = Auth::user()->getStorage()->name;
        // // $html = '<h1>Hello world</h1>';
        // return view('layouts.print', compact('username','date','title'));
         $view = \View::make('layouts.print', compact('username','date','title','storage'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));

        // $pdf = new TCPDF();
        // $pdf::SetTitle('Hello World');
        // $pdf::AddPage();
        // $pdf::writeHTML($html_content, true, false, true, false, '');
        // $pdf::Output('hello_world.pdf');

        // $username = Auth::user()->usr_usuario;
        // $title = "Reporte ";
        // $date =Carbon::now();
        // $html = view('layouts.test')->render();
        // // return view('layouts.print',compact('username','date','title'));


        // PDF::SetTitle('Hello World');
        // PDF::AddPage();
        // // PDF::writeHTML(view('layouts.print',compact('username','date','title'))->render(), true, false, true, false, '');
        // PDF::writeHTML($html, true, false, true, false, '');

        // PDF::Output('hello_world.pdf');
    }

    public function income_note($article_income_id)
    {
        $article_income = ArticleIncome::find($article_income_id);
        $username = Auth::user()->usr_usuario;
        $title = "NOTA DE INGRESO ";
        $date =Carbon::now();
        $persona = Auth::user()->getFullName();
        //return $persona;
        $gerencia = Auth::user()->employee->management->name;
        $storage = Auth::user()->getStorage()->name;//cambiar esto no me acuerdo por que lo deje estatico XD
        $code =  $article_income->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_income->created_at)->year;
        // // $html = '<h1>Hello world</h1>';
        // return view('layouts.print', compact('username','date','title'));
         $view = \View::make('report.income_note', compact('username','date','title','storage','article_income','persona','gerencia','code'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
    }

    public function request_note($article_request_id)
    {
        $article_request = ArticleRequest::find($article_request_id);
        $username = Auth::user()->usr_usuario;
        $title = "NOTA DE SOLICITUD";
        $date =Carbon::now();
        $user = User::where('usr_prs_id',$article_request->prs_id)->first();
        $persona = Auth::user()->getFullName(); //esto esta mal tambien
        $gerencia = Auth::user()->employee->management->name;
        $storage = $article_request->storage_destiny->name;
        $code =  $article_request->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_request->created_at)->year;
        $count = 1;
        $total_quantity=0;
        $view = \View::make('report.request_note', compact('username','date','title','storage','article_request','persona','gerencia','code','total_quantity','count'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
    }

    public function request_note_done($article_request_id)
    {
        $article_request = ArticleRequest::find($article_request_id);
        $username = Auth::user()->usr_usuario;
        $title = "NOTA DE SOLICITUD";
        $date =Carbon::now();
        $user = User::where('usr_prs_id',$article_request->prs_id)->first();
        $persona = $user->getFullName(); //esto esta mal tambien
        $gerencia = $user->getGerencia();
        $storage = $article_request->storage_origin->name;
        $storagedest = $article_request->storage_destiny->name;
        $code =  $article_request->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_request->created_at)->year;
        $count = 1;
        $total_quantity=0;
        $view = \View::make('report.request_storage_done', compact('username','date','title','storage','article_request','persona','gerencia','code','total_quantity','count','storagedest'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
    }

    public function request_note_doneview()
    {
        $funcionario = request('funcionario');
        Log::info($funcionario);
          $provider = request('provider');
        Log::info($provider);
        $type = request('type');
        Log::info($type);
        $numremision = request('numremision');
        Log::info($numremision);
        $fecha = request('fecha');
        Log::info($fecha);
        $incomes = json_decode(request('solicitud'));
        Log::info($incomes);
        $username = Auth::user()->usr_usuario;
        $user = Person::where('prs_id','=',Auth::user()->usr_prs_id)->get();
        $var= collect(($user));
        //return json_decode($user->prs_nombres);
        $title = "NOTA DE SALIDA ";
        $total_quantity=0;
        $date =Carbon::now();
        $count = 1;

       // $user = User::where('usr_prs_id',$article_request->prs_id)->first();
        // $persona = $user->getFullName(); //esto esta mal tambien
        // $gerencia = $user->getGerencia();
        // $storage = $article_request->storage_destiny->name;
        $code =  '';//$article_request->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_request->created_at)->year;

        $view = \View::make('report.request_storage_doneview', compact('username','date','title', 'code','provider','type','incomes', 'numremision','fecha','funcionario','total_quantity','count','user'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
        // $dompdf->stream();
    }

    public function minute_note($article_income_id)
    {
        $article_income = ArticleIncome::find($article_income_id);
        $username = Auth::user()->usr_usuario;
        $title = "ACTA DE RECEPCION ";
        $date =Carbon::now();
        $persona = Auth::user()->getFullName();
        $gerencia = Auth::user()->employee->management->name;
        $storage = Auth::user()->getStorage()->name;//cambiar esto no me acuerdo por que lo deje estatico XD
        $code =  $article_income->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_income->created_at)->year;
        // // $html = '<h1>Hello world</h1>';
        // return view('layouts.print', compact('username','date','title'));
         $view = \View::make('report.minute_note', compact('username','date','title','storage','article_income','persona','gerencia','code'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
    }

    public function out_note($article_request_id)
    {
        $article_request = ArticleRequest::find($article_request_id);
        $username = Auth::user()->usr_usuario;
        $title = "NOTA DE SALIDA ";
        $date =Carbon::now();
        $user = User::where('usr_prs_id',$article_request->prs_id)->first();
        $persona =  Auth::user()->getFullName(); //esto esta mal tambien
        $gerencia =  Auth::user()->employee->management->name;
        $storage = $article_request->storage_destiny->name;
        $code =  $article_request->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_request->created_at)->year;

        $view = \View::make('report.out_note', compact('username','date','title','storage','article_request','persona','gerencia','code'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
    }

    // public function articulo_view(Request $request)
    // {
    //     $art = Article::fin($request);
    //     $formart = json_encode(push('$art'));
    //     return $formart;
    // }

     public function vista_previa()
    {

        // $this.IncomeCreate::vista_previa();
        // $article_request = Article::find($article_id);
        // return $article_request;
        // echo $article_request;
        $provider = request('provider');
        Log::info($provider);
        $type = request('type');
        Log::info($type);
        $numremision = request('numremision');
        Log::info($numremision);
        $fecha = request('fecha');
        Log::info($fecha);
        $incomes = json_decode(request('incomes'));
        Log::info($incomes);
        $username = Auth::user()->usr_usuario;
        $title = "NOTA DE SALIDA ";
        $date =Carbon::now();

       // $user = User::where('usr_prs_id',$article_request->prs_id)->first();
        // $persona = $user->getFullName(); //esto esta mal tambien
        // $gerencia = $user->getGerencia();
        // $storage = $article_request->storage_destiny->name;
        $code =  '';//$article_request->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_request->created_at)->year;

        $view = \View::make('report.income_note_preview', compact('username','date','title', 'code','provider','type','incomes', 'numremision','fecha'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
        // $dompdf->stream();
    }

    public function vista_previa_RequestCheck()
    {
        $funcionario = request('funcionario');
        Log::info('hola roxy');
        Log::info($funcionario);
        //return $fu0ncionario;
        $gerencia = request('gerencia');
        Log::info($gerencia);
        $request = json_decode(request('salidas'));
        Log::info($request);
        $username = Auth::user()->usr_usuario;

        // $persona = $username->getFullName(); //esto esta mal tambien
        // $gerencia = $username->getGerencia();
        $title = "NOTA DE SALIDA ";
        $date =Carbon::now();

       // $user = User::where('usr_prs_id',$article_request->prs_id)->first();
        // $persona = $user->getFullName(); //esto esta mal tambien
        // $gerencia = $user->getGerencia();
        // $storage = $article_request->storage_destiny->name;
        $code =  '';//$article_request->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_request->created_at)->year;

        $view = \View::make('report.out_note_preview', compact('username','date','title', 'code','funcionario','gerencia','incomes','persona', 'request'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
        // $dompdf->stream();
    }

     public function vista_previa_RequestNote()
    {
        $funcionario = request('funcionario');
        Log::info('hola roxy');
        Log::info($funcionario);
        //return $fu0ncionario;
        $gerencia = request('gerencia');
        Log::info($gerencia);
        $article_request = json_decode(request('solicitud'));
        Log::info($article_request);
        $username = Auth::user()->usr_usuario;
        $count = 1;
        $total_quantity=0;
        $year=date('Y');

        // $persona = $username->getFullName(); //esto esta mal tambien
        // $gerencia = $username->getGerencia();
        $title = "NOTA DE SOLICITUD";
        $date =Carbon::now();

       // $user = User::where('usr_prs_id',$article_request->prs_id)->first();
        // $persona = $user->getFullName(); //esto esta mal tambien
        // $gerencia = $user->getGerencia();
        // $storage = $article_request->storage_destiny->name;
        $code =  '';//$article_request->correlative .'/'.Carbon::createFromFormat('Y-m-d H:i:s', $article_request->created_at)->year;

        $view = \View::make('report.request_note_preview', compact('username','date','title', 'code','funcionario','gerencia','incomes','persona', 'article_request','count','total_quantity','year'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));
        // $dompdf->stream();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function kardex_fisico($article_id)
    {
        $history = ArticleHistory::where('article_id',$article_id)
                                ->where('storage_id',Auth::user()->getStorage()->id)
                                ->get();
        $article = Article::find($article_id);
        $username = Auth::user()->usr_usuario;
        $date =Carbon::now();
        $count=1;
        $quantity=0;
        $code =  $article_id .'/'.$date->year;
        $title = "Kardex Fisico";
        $view = \View::make('report.kardex_fisico',compact('history','article','count','title','date','username','code','quantity'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));

    }

    public function kardex_valorado($article_id)
    {
        $history = ArticleHistory::where('article_id',$article_id)
                                    ->where('storage_id',Auth::user()->getStorage()->id)
                                    ->get();
        $article = Article::find($article_id);
        $username = Auth::user()->usr_usuario;
        $date =Carbon::now();
        $quantity=0;
        $count=1;
        $code =  $article_id .'/'.$date->year;
        $income_items = ArticleIncomeItem::where('article_id',$article_id)
                                        ->get();
                                        // return $income_items;
        // $income_item = $income_items->where('id',1)->first();
        // $income_item->quantity = 2;
        // $income_item = $income_items->where('id',2)->first();
        // $income_item->quantity = 10;


        // return $income_items;
        $title = "Kardex Valorado";
        // return var_dump($incomes);
        $view = \View::make('report.kardex_valorado',compact('history','article','count','title','date','username','code','quantity','income_items'));
        $html_content = $view->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html_content);

        // (Optional) Setup the paper size and orientation
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->setPaper('letter');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('my.pdf',array('Attachment'=>0));

    }
}
