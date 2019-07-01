<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Storage;
class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $storages = Storage::all();
        // return  $storages;

        return view("storage.index",compact("storages"));
    }

    public function getData(){
        $storages = Storage::all();
        return $storages;
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
            $storage = Storage::find($request->id);
        }else{
            $storage = new Storage;
        }
        $storage->name = $request->name;
        $storage->description = $request->description;
        $storage->save();

        session()->flash('message','Se registro el Almacen '.$storage->name);

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
        $storage = Storage::find($id);
        return $storage;    
        return response()->json(compact('storage'));
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
        $storage = Storage::find($id);
        $name = $storage->name;
        $storage->delete();
        session()->flash('delete','se elimino el registro '.$name);
        return $id;
    }
}
