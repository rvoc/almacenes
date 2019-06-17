<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestChangeIncomeItem extends Model
{
    //
    protected $table="sisme.request_change_income_items";

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
    public function article_income_item(){
        return $this->belongsTo('App\ArticleIncomeItem')->with('article');
    }
}
