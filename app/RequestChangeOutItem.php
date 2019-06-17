<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestChangeOutItem extends Model
{
    //
    protected $table = "sisme.request_change_out_items";

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function article_request_item()
    {
        return $this->belongsTo('App\ArtileRequestItem');
    }
}
