<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    //
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function budge_item()
    {
        return $this->belongsTo("App\BudgeItem");
    }

    public function unit()
    {
        return $this->belongsTo("App\Unit");
    }

}
