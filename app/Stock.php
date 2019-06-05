<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $table = "sisme.stocks";

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
    public function article_income_item()
    {
        return $this->belongsTo('App\ArticleIncomeItem');
    }
}
