<?php

namespace App\Providers;

// use App\Observers\IncomeObserver;
// use App\Observers\IncomeRequestItemObserver;
use App\ArticleIncomeItem;
use App\ArticleRequestItem;
use App\ArticleHistory;
use App\Stock;
use Log;
use Auth;
use DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //example for
        // \App\ArticleIncomeItem::observe(\App\Observers\IncomeRequestItemObserver::class);
        // User::observe(serObserver::class);// forma convencional Xd
        // ArticleIncomeItem::observe(IncomeObserver::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        require_once __DIR__ . '/../Http/Helpers/Navigation.php';
        //segunda forma convencional Observer en el boot
        ArticleIncomeItem::saved(function ($model) {
            Log::info('funciona saved');
            Log::info($model);
            $stocks = Stock::where('storage_id',Auth::user()->getStorage()->id)
                            ->where('article_id',$model->article_id)
                            ->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))
                            ->groupBy('stocks.article_id')->get();
            $article_history = new ArticleHistory;
            $article_history->article_income_item_id =$model->id;
            $article_history->article_id =$model->article_id;
            $article_history->type ='Entrada';
            $article_history->stock_quantity =  $stocks[0]->quantity;
            $article_history->save();
        });
        // Stock::saved(function ($model){
        //     Log::info('actualizando la hueva del stokc');
        // });
        ArticleRequestItem::saved(function ($model) {
            Log::info('actualizando el item ');
            // Log::info($model);
            Log::info($model->article_request);
            if($model->article_request->state=='Aprobado')
            {
                Log::info("se esta realizando los calculos  XD");

                $stocks = Stock::where('storage_id',Auth::user()->getStorage()->id)
                                ->where('article_id',$model->article_id)
                                ->select('article_id',DB::raw('sum(stocks.quantity) as quantity'))
                                ->groupBy('stocks.article_id')->get();
                $article_history = new ArticleHistory;
                $article_history->article_request_item_id =$model->id;
                $article_history->article_id =$model->article_id;
                $article_history->type ='Salida';
                $article_history->stock_quantity =  $stocks[0]->quantity;
                $article_history->save();
            }
        });


    }
}
