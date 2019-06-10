<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleIncomeItem extends Model
{
    //
    protected $table = "sisme.article_income_items";

    public function article()
    {
        return $this->belongsTo('App\Article')->with('unit');
    }

    public function article_income()
    {
        return $this->belongsTo('App\ArticleIncome');
    }
}
