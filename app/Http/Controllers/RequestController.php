<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleRequest;
use App\ArticleRequestItem;
use Illuminate\Support\Facades\Auth;
use App\Stock;
use App\Article;
use App\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // para articulos de almacen
        $request_articles = ArticleRequest::where('storage_id',Auth::user()->getStorage()->id)
                                            ->get();
        return view('request.index',compact('request_articles'));
    }

    public function index_person(){
        $request_articles = ArticleRequest::where('prs_id',Auth::user()->person()->prs_id)
                                            // ->where('storage_id',Auth::user()->getStorage()->id)
                                            // ->orderBy('storage_id','Asc')
                                            ->get();
        return view('request.index_person',compact('request_articles'));
    }

    public function transfer()
    {
        // return 'test';
        $storages = Storage::all();
        return view('request.transfer',compact('storages'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $articles = Stock::join('articles','articles.id','=','stocks.article_id')
        //                 ->where('storage_id',Auth::user()->getStorage()->id)
        //                 ->select('article_id','articles.name',DB::raw('sum(stocks.quantity) as quantity'))
        //                 ->groupBy('stocks.article_id','articles.name')->get();

        $articles = Article::with('category','unit')
                            ->join('stocks','stocks.article_id','=','articles.id')
                            ->where('storage_id',Auth::user()->getStorage()->id)
                            ->select('article_id','articles.name','articles.category_id','articles.unit_id',DB::raw('sum(stocks.quantity) as quantity_stock'))
                            ->groupBy('stocks.article_id','articles.name','articles.category_id','articles.unit_id')
                            ->get();
        // $articles = Article::with('budget_item')->get();
        // return $articles;
        return view('request.create',compact('articles'));
    }

    public function storageArticles($storage_id){

        $articles = Article::with('category','unit')
                            ->join('stocks','stocks.article_id','=','articles.id')
                            ->where('storage_id',$storage_id)
                            ->select('article_id','articles.name','articles.category_id','articles.unit_id',DB::raw('sum(stocks.quantity) as quantity_stock'))
                            ->groupBy('stocks.article_id','articles.name','articles.category_id','articles.unit_id')
                            ->get();

        return response()->json($articles);
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
        if($request->has('storage_id')){
            $storage_id = $request->storage_id;
        }else{
            $storage_id = Auth::user()->getStorage()->id;
        }

        $last_income = ArticleRequest::where('storage_id',$storage_id)->max('correlative');
        $counter=0;
        // return $counter;
        if(!$last_income){
            $counter=1;
        }
        else{
            $counter=$last_income+1;
        }


        $articles = json_decode($request->articles);
        // return $articles;
        $article_request = new ArticleRequest;
        $article_request->storage_id = $storage_id;
        $article_request->prs_id = Auth::user()->person()->prs_id;
        $article_request->correlative = $counter;
        $article_request->save();


        foreach($articles as $article)
        {
            $article_request_item = new ArticleRequestItem;
            $article_request_item->article_request_id = $article_request->id;
            $article_request_item->article_id = $article->article->article_id;
            $article_request_item->quantity = $article->quantity;
            $article_request_item->quantity_apro = $article->quantity;
            $article_request_item->save();

            // $stock = new Stock;
            // $stock->article_id = $article_request_item->article_id;
            // $stock->storage_id = $article_income->storage_id;
            // $stock->article_request_item_id = $article_request_item->id;
            // $stock->quantity = $article_request_item->quantity;
            // $stock->cost = $article_request_item->cost;
            // $stock->save();

            // $article_income_item->article_id = $article->;
        }
        return redirect('request_person');
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

        $article_request = ArticleRequest::with('person')->find($id);
        $article_request_items = $article_request->article_request_items;



        // $stock = Stock::where('article_id',1)
        //                 ->where('storage_id',1)
        //                 ->select(DB::raw('sum(quantity) as stock'))
        //                 ->groupBy('article_id')
        //                 ->first();
        //return $article_request_items;
        // return $stock;
        // $articles = array();
        foreach($article_request_items as $items)
        {
            $items->stock = Stock::where('article_id',$items->article->id)
                            ->where('storage_id',Auth::user()->getStorage()->id)
                            ->select(DB::raw('sum(quantity) as stock'))
                            ->groupBy('article_id')
                            ->first();

            // array_push($articles,array('article'))
        }
        // return $article_request_items;

        // $articles;
        return view('request.check_request',compact('article_request','article_request_items'));

    }

    public function confirmRequest(Request $request){
        $articles = json_decode($request->articles);


        foreach($articles as $article){
            $article_request_item = ArticleRequestItem::find($article->id);
            $article_request_item->quantity_apro =$article->quantity_apro;
            //obtener lista de los productos en stock de este almacen
            $stocks = Stock::where('article_id',$article->id)
                            ->where('storage_id',Auth::user()->getStorage()->id)
                            ->orderBy('created_at','Asc')
                            ->get();

            // return $stocks;
            $quantity=$article->quantity_apro;
            // return $quantity;
            foreach($stocks as $stock)
            {
                // Log::warning($quantity);
                    if($quantity>0){
                        if($quantity >= $stock->quantity){
                            $stock->quantity = $quantity - $stock->quantity;
                            $quantity = $quantity - $stock->quantity;
                            // Log::info('cantidad >=: '.$stock->quantity);
                        }else
                        {
                            $stock->quantity = $stock->quantity - $quantity;
                            $quantity = $quantity - $stock->quantity ;
                            // Log::info('cantidad <: '.$stock->quantity);
                        }

                        $stock->save();
                    }
            }

            // return $stocks;
            $article_request_item->save();
        }
        $article_request = ArticleRequest::find($request->article_request_id);
        $article_request->state = "Aprobado";
        $article_request->save();

        return redirect('request');
        // return $articles;
    }

    public function delivery(Request $request){
        //
        $article_request = ArticleRequest::find($request->data['id']);
        $article_request->state ="Entregado";
        $article_request->save();
        return $article_request;
        // return ;
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
