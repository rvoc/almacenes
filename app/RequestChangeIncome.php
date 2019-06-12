<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestChangeIncome extends Model
{
    //
    protected $table="sisme.request_change_incomes";

    public function article_income()
    {
        return $this->belongsTo('App\ArticleIncome')->with('provider','person','article_income_items');
    }

    public function request_change_income_items()
    {
        return $this->hasMany('App\RequestChangeIncomeItem')->with('article_income_item');
    }
}
