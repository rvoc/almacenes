<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BudgetItem extends Model
{
    //
    protected $table = "sisme.budget_items";

    use SoftDeletes;
}
