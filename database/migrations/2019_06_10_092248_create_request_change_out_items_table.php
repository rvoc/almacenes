<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestChangeOutItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sisme.request_change_out_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            // article_income_items
            $table->integer('request_change_out_id');
            $table->foreign('request_change_out_id')->references('id')->on('sisme.request_change_outs');

            $table->integer('article_request_item_id');
            $table->foreign('article_request_item_id')->references('id')->on('sisme.article_request_items');
            $table->decimal('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sisme.request_change_out_items');
    }
}
