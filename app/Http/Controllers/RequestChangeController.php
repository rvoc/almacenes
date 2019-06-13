<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleIncome;
use App\RequestChangeIncome;
use App\RequestChangeIncomeItem;
use App\RequestChangeOut;
use App\RequestChangeOutItem;
use App\Article;
use App\ArticleRequest;
use App\Stock;
use DB;
use Auth;
class RequestChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //primero ver  request de solo la sucursal
        $request_incomes = [];
        $request_outs = [];

        $request_all_in = RequestChangeIncome::where('storage_id',Auth::user()->getStorage()->id)->get();
        $request_all_out = RequestChangeOut::where('storage_id',Auth::user()->getStorage()->id)->get();


        if(Auth::user()->hasRole('Encargado de Almacen'))
        {
            $request_incomes = RequestChangeIncome::where('storage_id',Auth::user()->getStorage()->id)
                                                    ->where('state','Pendiente Aprobacion')
                                                    ->get();

            $request_outs = RequestChangeOut::where('storage_id',Auth::user()->getStorage()->id)
                                            ->where('state','Pendiente Aprobacion')
                                            ->get();
        }

        if(Auth::user()->hasRole('Encargado de Oficina Central'))
        {
            $request_incomes = RequestChangeIncome::where('storage_id',Auth::user()->getStorage()->id)
                                                    ->where('state','Pendiente')
                                                    ->get();

            $request_outs = RequestChangeOut::where('storage_id',Auth::user()->getStorage()->id)
                                                    ->where('state','Pendiente')
                                                    ->get();
        }


        return view('request_change.index',compact('request_incomes','request_all_in','request_all_out','request_outs'));

    }

    public function create_change_income($article_income_id)
    {
        $article_income = ArticleIncome::with('article_income_items')->find($article_income_id);
        $articles = Article::with('unit')->get();//cambiar articulos por los articulos de inventario

        // return $articles;
        return view('request_change.create_income',compact('article_income','articles'));
    }

    public function create_change_out($article_request_id)
    {
        $article_request = ArticleRequest::with('article_request_items')->find($article_request_id);
        //$articles = Article::with('unit')->get();
        $articles = array();
        $stocks = Stock::with('article')->where('storage_id',Auth::user()->getStorage()->id)->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))->groupBy('stocks.article_id')->get();

        // $articles = json_encode($articles);
        // $articles = json_decode($articles);
        // return $articles;
        return view('request_change.create_out',compact('article_request','stocks'));
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
    public function store(Request $request) //neto para el income
    {
        //
        $request_change = new RequestChangeIncome;
        $request_change->article_income_id = $request->article_income_id;
        $request_change->type = $request->type;
        $request_change->description = $request->observation;
        $request_change->user_id = Auth::user()->usr_id;
        $request_change->storage_id = Auth::user()->getStorage()->id;
        $request_change->save();

        $request_change_income_items = json_decode($request->request_income_items);
        // return $request_change_income_items;
        foreach($request_change_income_items as $request_income_item)
        {
            // if($request_income_item->id>0) //para los que son distintos de nuevos donde id nuevo = 0
            // {
                $request_change_income_item = new RequestChangeIncomeItem;
                $request_change_income_item->request_change_income_id = $request_change->id;
                $request_change_income_item->article_id = $request_income_item->article_id;//revisar
                $request_change_income_item->cost = $request_income_item->new_cost;
                $request_change_income_item->quantity = $request_income_item->new_quantity;
                $request_change_income_item->save();
            // }
        }
        return redirect('request_change');
    }

    public function store_out(Request $request)
    {
        // return $request->all();
        $request_change_out = new RequestChangeOut;
        $request_change_out->type = $request->type;
        $request_change_out->article_request_id = $request->article_request_id;
        $request_change_out->description = $request->observation;
        $request_change_out->user_id = Auth::user()->usr_id;
        $request_change_out->storage_id = Auth::user()->getStorage()->id;
        $request_change_out->save();
        // return $request_change_out;
        $request_change_out_items = json_decode($request->request_out_items);
        // return $request_change_out_items;
        foreach($request_change_out_items as $request_out_item)
        {
            // if($request_out_item->id>0) //para los que son distintos de nuevos donde id nuevo = 0
            // {
                $request_change_out_item = new RequestChangeOutItem;
                $request_change_out_item->request_change_out_id = $request_change_out->id;
                $request_change_out_item->article_id = $request_out_item->article_id;
                $request_change_out_item->quantity = $request_out_item->new_quantity;
                $request_change_out_item->save();
            // }
        }

        return redirect('request_change');
        // return back()->withInput();
    }

    public function firstConfirmation(Request $request)
    {

        $request_change_income = RequestChangeIncome::find($request->request_change_income_id);
        switch ($request_change_income->state) {
            case 'Pendiente Aprobacion':
                # code...
                    $request_change_income->state = 'Pendiente';
                break;
            case 'Pendiente':
                # code...
                    $request_change_income->state = 'Aprobado';
                    # colocar logica de codigo
                break;
        }
        $request_change_income->save();

        return back()->withInput();
        // return $request->all();
    }

    public function  confirmOut(Request $request)
    {
        $request_change_out = RequestChangeOut::find($request->request_change_out_id);
        // return $request_change_out;
        switch ($request_change_out->state) {
            case 'Pendiente Aprobacion':
                # code...
                    $request_change_out->state = 'Pendiente';
                break;
            case 'Pendiente':
                # code...
                    $request_change_out->state = 'Aprobado';
                    # colocar logica de codigo
                break;
        }
        $request_change_out->save();

        return back()->withInput();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //para entradas
    {
        $request_change_income = RequestChangeIncome::with('request_change_income_items','article_income')->find($id);
        return response()->json($request_change_income);
    }

    public function show_out($id) //para salidas
    {
        $request_change_out = RequestChangeOut::with('request_change_out_items','article_request')->find($id);
        return response()->json($request_change_out);
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
