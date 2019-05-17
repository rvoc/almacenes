<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArticleRequest;
use App\ArticleRequestItem;
use Illuminate\Support\Facades\Auth;
use App\Stock;
use App\Article;
use Illuminate\Support\Facades\DB;
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
                                            ->where('storage_id',Auth::user()->getStorage()->id)
                                            ->get();
        return view('request.index_person',compact('request_articles'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $last_income = ArticleRequest::max('correlative');
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
        $article_request->storage_id = Auth::user()->getStorage()->id;
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
        $article_request = ArticleRequest::with('article_request_items')->find($id);
        $article_request_items = $article_request->article_request_items;

        return view('request.check_request',compact('article_request'));

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
