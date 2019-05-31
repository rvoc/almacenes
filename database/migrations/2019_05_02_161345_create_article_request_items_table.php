<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleRequestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_request_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('article_request_id');
            $table->foreign('article_request_id')->references('id')->on('article_requests');
            $table->integer('article_id');
            $table->foreign('article_id')->references('id')->on('articles');
            $table->decimal('quantity');
            $table->decimal('quantity_apro');
            $table->integer('article_income_item_id')->nullable(); //entradas
            $table->foreign('article_income_item_id')->references('id')->on('article_income_items');
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
        Schema::dropIfExists('article_request_items');
    }
}
