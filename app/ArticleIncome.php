<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleIncome extends Model
{
    //
    protected $table = "sisme.article_incomes";
    public function provider()
    {
        return $this->belongsTo("App\Provider");
    }

    public function person()
    {
        return $this->belongsTo("App\Person","prs_id","prs_id");
    }

    public function article_income_items ()
    {
        return $this->hasMany('App\ArticleIncomeItem')->with('article');
    }

    public function getTotalQuantity()
    {
        $quantity=0;
        foreach($this->article_income_items as $item){
            $quantity += $item->quantity;
        }
        return $quantity;
    }
}
