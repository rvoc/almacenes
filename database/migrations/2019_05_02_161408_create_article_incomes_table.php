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
            $table->integer('provider_id');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->integer('prs_id');
            $table->foreign('prs_id')->references('prs_id')->on('siscor._bp_personas');
            $table->string('path_invoice')->nullable();
            $table->string('dependence')->nullable();
            $table->string('remision_number')->nullable();
            $table->date('date')->nullable();
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
