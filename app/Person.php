<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
    protected $table = "siscor._bp_personas";

    protected $primaryKey = "prs_id";

    public function getUser(){
        return User::where('usr_prs_id',$this->prs_id)->first();
    }
}
