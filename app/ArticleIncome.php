<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleIncome extends Model
{
    //
    public function provider()
    {
        return $this->belongsTo("App\Provider");
    }

    public function person()
    {
        return $this->belongsTo("App\Person","prs_id","prs_id");
    }

    public function article_income_items ()
    {
        return $this->hasMany('App\ArticleIncomeItem');
    }
}
