<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleRequest extends Model
{
    //

    public function storage_origin(){
        return $this->belongsTo('App\Storage','storage_origin_id');
    }
    public function storage_destiny(){
        return $this->belongsTo('App\Storage','storage_destiny_id');
    }

    public function person(){
        return $this->belongsTo('App\Person','prs_id','prs_id');
    }

    public function article_request_items()
    {
        return $this->hasMany('App\ArticleRequestItem')->with('article');
    }
}
