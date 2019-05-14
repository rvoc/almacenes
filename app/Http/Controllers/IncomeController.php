<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Storage;
use App\Article;
use App\Provider;
use App\ArticleIncome;
use App\ArticleIncomeItem;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $incomes = ArticleIncome::where('storage_id',Auth::user()->getStorage()->id)->get();
        return view('income.index',compact('incomes'));

    }

    // public function storage_article($storage_id){
    //     $storage = Storage::find($storage_id);
    //     //$articles = Article::where('storage_id',$storage_id)->get();
    //     return view('article.index',compact('articles','storage'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $articles = Article::with('budget_item')->get();
        $providers = Provider::all();
        return view('income.create',compact('articles','providers'));
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
        // return $request->all();
        $articles = json_decode($request->articles);
        // return $articles;
        $article_income = new ArticleIncome;
        $article_income->provider_id = $request->provider_id;
        $article_income->storage_id = Auth::user()->getStorage()->id;
        $article_income->prs_id = Auth::user()->person()->prs_id;
        $article_income->type = $request->type;
        $article_income->save();


        // $article_income->path_invoce = $request->path_invoce;
        // $article_income->remision_number = $request->remision_number;
        // $article_income->date = $request->date;
        foreach($articles as $article)
        {
            $article_income_item = new ArticleIncomeItem;
            $article_income_item->article_income_id = $article_income->id;
            $article_income_item->article_id = $article->article->id;
            $article_income_item->cost = $article->cost;
            $article_income_item->quantity = $article->quantity;
            $article_income_item->save();
            // $article_income_item->article_id = $article->;
        }



        return $article_income;
        return $request->all();
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