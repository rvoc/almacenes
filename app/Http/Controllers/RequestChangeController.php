<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleIncome;
use App\RequestChangeIncome;
use App\RequestChangeIncomeItem;
use App\Article;
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
        $request_income = [];
        //primero ver  request de solo la sucursal

        if(Auth::user()->hasRole('Encargado de Almacen'))
        {
            $request_incomes = RequestChangeIncome::where('storage_id',Auth::user()->getStorage()->id)
                                                    ->where('state','Pendiente Aprobacion')
                                                    ->get();
        }

        if(Auth::user()->hasRole('Encargado de Oficina Central'))
        {
            $request_incomes = RequestChangeIncome::where('storage_id',Auth::user()->getStorage()->id)
                                                    ->where('state','Pendiente')
                                                    ->get();
        }


        return view('request_change.index',compact('request_incomes'));

    }

    public function create_change_income($article_income_id)
    {
        $article_income = ArticleIncome::with('article_income_items')->find($article_income_id);
        $articles = Article::with('unit')->get();
        // return $articles;
        return view('request_change.create_income',compact('article_income','articles'));
    }

    public function create_change_out()
    {

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
                $request_change_income_item->article_income_item_id = $request_income_item->article_income_id;
                $request_change_income_item->cost = $request_income_item->new_cost;
                $request_change_income_item->quantity = $request_income_item->new_quantity;
                $request_change_income_item->save();
            // }
        }
        return redirect('request_change');
    }

    public function firstConfirmation(Request $request)
    {

        $request_change_income = RequestChangeIncome::find($request->request_change_income_id);
        if($request_change_income->state =='Pendiente Aprobacion')
        {
            $request_change_income->state = 'Pendiente';
            $request_change_income->save();
        }
        if($request_change_income->state =='Pendiente')
        {
            $request_change_income->state = 'Aprobado';
            $request_change_income->save();
            //colocar logica de modificacion de nota
        }

        return back()->withInput();
        // return $request->all();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request_change_income = RequestChangeIncome::with('request_change_income_items','article_income')->find($id);
        return response()->json($request_change_income);
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
