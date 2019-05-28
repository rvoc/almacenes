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
use App\Stock;
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
        $gerencia = Auth::user()->getGerencia();
        $storage = Auth::user()->getStorage()->name;
        // // $html = '<h1>Hello world</h1>';
        // return view('layouts.print', compact('username','date','title'));
         $view = \View::make('report.income_note', compact('username','date','title','storage','article_income','persona','gerencia'));
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

}
