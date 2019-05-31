<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleIncomeItem extends Model
{
    //
    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function article_income()
    {
        return $this->belongsTo('App\ArticleIncome');
    }
}
