<?php

namespace App\Observers;
use App\ArticleIncomeItem;
use Log;
class IncomeRequestItemObserver
{
    //
    public function created(ArticleIncomeItem $item)
    {
        //
        Log::inf('no funciona ooX');
        Log::info($item);
    }
    // public function created(Affiliate $affiliate){
    //     Log::info('affiliado creado');
    //     Log::info($affiliate);
    // }
}
