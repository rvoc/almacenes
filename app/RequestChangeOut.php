<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestChangeOut extends Model
{
    //
    protected $table = "sisme.request_change_outs";

    // public function article()
    // {
    //     return $this->belongsTo('App\Article');
    // }
    public function article_request()
    {
        return $this->belongsTo('App\ArticleRequest');
    }

    public function request_change_out_items()
    {
        return $this->hasMany('App\RequestChangeOutItem');
    }
}
