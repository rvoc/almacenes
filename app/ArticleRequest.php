<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleRequest extends Model
{
    //
    protected $table = "sisme.article_requests";

    public function storage_origin(){
        return $this->belongsTo('App\Storage','storage_origin_id');
    }
    public function storage_destiny(){
        return $this->belongsTo('App\Storage','storage_destiny_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee','employee_id','id')->with('management');
    }
    
    public function person(){
        return $this->belongsTo('App\Person','id','id');
    }

    public function article_request_items()
    {
        return $this->hasMany('App\ArticleRequestItem')->with('article');
    }
}
