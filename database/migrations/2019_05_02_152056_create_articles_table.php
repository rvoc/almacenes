<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("code");
            $table->integer('budget_item_id');
            $table->foreign('budget_item_id')->references('id')->on('budget_items');
            $table->integer('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
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
        Schema::dropIfExists('articles');
    }
}
