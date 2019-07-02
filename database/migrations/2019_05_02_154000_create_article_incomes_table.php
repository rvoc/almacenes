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
        Schema::create('sisme.article_incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->bigInteger("correlative")->nullable();
            $table->integer('storage_id');
            $table->foreign('storage_id')->references('id')->on('sisme.storages');
            $table->integer('provider_id');
            $table->foreign('provider_id')->references('id')->on('sisme.providers');
            $table->integer('employee_id'); //persona que solicita el articulo
            $table->foreign('employee_id')->references('id')->on('rrhh.employees');
            $table->string('path_invoice')->nullable();
            $table->string('dependence')->nullable();
            $table->string('remision_number')->nullable();
            $table->date('date')->nullable();
            $table->enum('type', ['Ingreso', 'Traspaso' ,'Reingreso']);
            $table->decimal('total_cost');
            $table->unsignedInteger('correlative')->index();
            $table->unique( array('storage_id','correlative'));
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
        Schema::dropIfExists('sisme.article_incomes');
    }
}
