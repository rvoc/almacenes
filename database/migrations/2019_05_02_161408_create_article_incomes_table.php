<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('storage_id');
            $table->foreign('storage_id')->references('id')->on('storages');
            $table->string('path_invoice')->nullable();
            $table->string('remision_number')->nullable();
            $table->date('date');
            $table->enum('type', ['Ingreso', 'Traspaso' ,'Reingreso']);
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
        Schema::dropIfExists('article_incomes');
    }
}
