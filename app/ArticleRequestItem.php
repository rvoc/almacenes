<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleRequestItem extends Model
{
    //

    public function article()
    {
        return $this->belongsTo('App\Article')->with('unit');
    }

    public function article_request()
    {
        return $this->belongsTo('App\ArticleRequest');
    }
}
