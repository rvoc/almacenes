<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Storage;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = Article::withTrashed()->get();
        return view('article.index',compact('articles'));
    }

    public function storage_article($storage_id){
        $storage = Storage::find($storage_id);
        $articles = Article::where('storage_id',$storage_id)->get();
        return view('article.index',compact('articles','storage'));
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
        //return $request->all();
        if($request->has("id")){
            $article = Article::find($request->id);
        }else{
            $article = new Article;
        }
        $article->name = $request->name;
        $article->code = $request->code;
        $article->budget_item_id = $request->budget_item_id;
        $article->category_id = $request->category_id;
        $article->provider_id = $request->provider_id;
        $article->unit_id = $request->unit_id;
        $article->save();

        session()->flash('message','Se registro el Articulo '.$article->name);

        return back()->withInput();
        // $article = new Article;
        // $article->
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
        $article = Article::with('unit','category','budget_item','provider')->find($id);
        return response()->json(compact('article'));
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
        $article = Article::withTrashed()->find($id);
        $article->deleted_at = null;
        $article->save();
        session()->flash('message','se Activo el articulo '.$article->name);
        return $id;
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
        $article = Article::find($id);
        $name = $article->name;
        $article->delete();
        session()->flash('delete','se Inactivo el articulo '.$name);
        return $id;
    }
}
