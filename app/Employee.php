<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = "rrhh.employees";

    public function getFullName()
    {
        return $this->first_name.' '.$this->last_name.' '.$this->mother_last_name;
    }
}
