<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $table = "sisme.stocks";

    public function article()
    {
        return $this->belongsTo('App\Article')->with('unit');
    }
    public function article_income_item()
    {
        return $this->belongsTo('App\ArticleIncomeItem')->with('article_income');
    }
}
