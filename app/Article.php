<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    //
    protected $table = "sisme.articles";
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function budget_item()
    {
        return $this->belongsTo("App\BudgetItem");
    }

    public function unit()
    {
        return $this->belongsTo("App\Unit");
    }

    // public function provider()
    // {
    //     return $this->belongsTo("App\Provider");
    // }

}
