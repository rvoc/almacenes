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
        Schema::create('sisme.articles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string("name");
            $table->string("code");
            $table->integer('budget_item_id');
            $table->foreign('budget_item_id')->references('id')->on('sisme.budget_items');
            $table->integer('category_id');
            $table->foreign('category_id')->references('id')->on('sisme.categories');
            $table->integer('unit_id');
            $table->foreign('unit_id')->references('id')->on('sisme.units');


            // $table->integer('storage_id');
            // $table->foreign('storage_id')->references('id')->on('storages');
            // $table->integer('provider_id');
            // $table->foreign('provider_id')->references('id')->on('providers');
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
        Schema::dropIfExists('sisme.articles');
    }
}
