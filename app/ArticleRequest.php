<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleRequest extends Model
{
    //

    public function storage(){
        return $this->belongsTo('App\Storage');
    }

    public function person(){
        return $this->belongsTo('App\Person','prs_id','prs_id');
    }

    public function article_request_items()
    {
        return $this->hasMany('App\ArticleRequestItem')->with('article');
    }
}
