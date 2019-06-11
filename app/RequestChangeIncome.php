<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestChangeIncome extends Model
{
    //
    protected $table="sisme.request_change_incomes";

    public function article_income()
    {
        return $this->belongsTo('App\ArticleIncome');
    }

    // public function article_request_items()
    // {
    //     return $this->hasMany('App\ArticleRequestItem')->with('article');
    // }
}
