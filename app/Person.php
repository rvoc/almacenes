<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
    protected $table = "rrhh.employees";
    public $timestamps = false;
    protected $primaryKey = "id";

    public function getUser(){
        return User::where('usr_prs_id',$this->id)->first();
    }

}
