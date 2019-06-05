<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleIncomeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sisme.article_income_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('article_income_id');
            $table->foreign('article_income_id')->references('id')->on('sisme.article_incomes');
            $table->integer('article_id');
            $table->foreign('article_id')->references('id')->on('sisme.articles');
            $table->decimal('quantity');
            $table->decimal('cost');
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
        Schema::dropIfExists('sisme.article_income_items');
    }
}
