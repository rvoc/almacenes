<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //categories
    protected $table = "sisme.categories";
    use SoftDeletes;
}
