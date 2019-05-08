<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BudgetItem;

class BudgeItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $budge_items = BudgetItem::all();
        return view("budge_item.index",compact("budge_items"));
    }

    public function getData()
    {
        $budge_items = BudgetItem::all();
        return $budge_items;
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
        if($request->has("id")){
            $budge_item = BudgetItem::find($request->id);
        }else{
            $budge_item = new BudgetItem;
        }
        $budge_item->name = $request->name;
        $budge_item->description = $request->description;
        $budge_item->save();

        session()->flash('message','Se registro la partida '.$budge_item->name);

        return back()->withInput();
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
        $budge_item = BudgetItem::find($id);
        return response()->json(compact('budge_item'));
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
        $budge_item = BudgetItem::find($id);
        $name = $budge_item->name;
        $budge_item->delete();
        session()->flash('delete','se elimino el registro '.$name);
        return $id;
    }
}
