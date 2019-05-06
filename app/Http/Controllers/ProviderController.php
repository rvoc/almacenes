<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;
class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $providers = Provider::all();
        return view('provider.index',compact('providers'));
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
            $provider = Provider::find($request->id);
        }else{
            $provider = new Provider;
        }
        $provider->name = $request->name;
        $provider->phone = $request->phone;
        $provider->address = $request->address;
        $provider->first_name = $request->first_name;
        $provider->last_name = $request->last_name;
        $provider->mother_last_name = $request->mother_last_name;
        $provider->cellphone = $request->cellphone;
        $provider->save();

        session()->flash('message','Se registro al proveedor '.$provider->name);

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
        $provider = Provider::find($id);
        return response()->json(compact('provider'));
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
        $provider = Provider::find($id);
        $name = $provider->name;
        $provider->delete();
        session()->flash('delete','se elimino el registro '.$name);
        return $id;
        // return response()->json(compact('provider'));

    }
}
