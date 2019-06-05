<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Log;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::with('person')->get();
        // return $users;
        return view('user.index',compact('users'));
    }

    public function system()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        // return $roles;
        return view('system.index',compact('roles','permissions'));
    }

    public function changeStore(Request $request)
    {
        session()->put('storage_id', $request->storage_id);
        // return $request->all();
        return back()->withInput();
    }

    public function storeRole(Request $request)
    {
        //creando roles y adicionando permisos
        if($request->has('id'))
        {
            $role = Role::find($request->id);
        }else {

            $role = Role::create(['name' => $request->name]);
        }
        // return $request->all();
        $permissions = json_decode($request->permissions);
        foreach ($permissions as $permission)
        {
            # code...
            if($permission->enabled)
            {
                $role->givePermissionTo(''.$permission->name);
            }else {
                $role->revokePermissionTo(''.$permission->name);
            }
        }

        return back()->withInput();
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

    public function storeSystem(Request $request)
    {
        //
        $system = Permission::find($request->id);
        $system->name = $request->name;
        $system->save();
        return back()->withInput();
    }

    public function getPermissionRol($role_id)
    {
        if($role_id > 0)
        {
            $role = Role::find($role_id);
        }else
        {
            $role = null;
        }

        $permissions = Permission::all();
        Log::info($permissions->count());
        foreach ($permissions as $permission) {

           if($role){

               if($role->hasPermissionTo($permission->name)){
                   $permission->enabled = true;
               }else
               {
                   $permission->enabled = false;
               }
           }else
           {
                $permission->enabled = false;
           }

        }

        return response()->json(compact('role','permissions'));
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
        $user = User::find($id);
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
    }
}
