<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sisme.stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('article_id');
            $table->foreign('article_id')->references('id')->on('sisme.articles');
            $table->integer('storage_id');
            $table->foreign('storage_id')->references('id')->on('sisme.storages');
            $table->integer('article_income_item_id');
            $table->foreign('article_income_item_id')->references('id')->on('sisme.article_income_items');
            $table->decimal('quantity');
            $table->decimal('cost',8,5);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sisme.stocks');
    }
}
