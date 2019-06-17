<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestChangeIncomeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sisme.request_change_income_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('request_change_income_id');
            $table->foreign('request_change_income_id')->references('id')->on('sisme.request_change_incomes');
            $table->integer('article_id');
            $table->foreign('article_id')->references('id')->on('sisme.articles');
            $table->integer('article_income_item_id')->nullable(); //entradas a la cuales se afectaran en caso de null es un nuevo item 
            $table->foreign('article_income_item_id')->references('id')->on('sisme.article_income_items');
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
        Schema::dropIfExists('sisme.request_change_income_items');
    }
}
