<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleHistory extends Model
{
    //
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
    public function article_income_item()
    {
        return $this->belongsTo('App\ArticleIncomeItem','article_income_item_id');
    }
    public function article_request_item()
    {
        return $this->belongsTo('App\ArticleRequestItem');
    }

}
