<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            //establecer usuarios yo funcionarios
            $table->integer('storage_origin_id'); //origin
            $table->foreign('storage_origin_id')->references('id')->on('storages');
            $table->integer('storage_destiny_id'); //destitny
            $table->foreign('storage_destiny_id')->references('id')->on('storages');
            // $table->integer("number_request")->nullable();// correlativo
            $table->integer('prs_id'); //persona que solicita el articulo
            $table->foreign('prs_id')->references('prs_id')->on('siscor._bp_personas');

            $table->integer('user_id')->nullable();//usuario quien aprueba o rechaza el articulo
            $table->foreign('user_id')->references('usr_id')->on('siscor._bp_usuarios');

            $table->enum('state', ['Aprobado', 'Rechazado' ,'Entregado','Pendiente'])->default('Pendiente');
            $table->unsignedInteger('correlative')->index();
            $table->enum('type', ['Funcionario', 'Almacen'])->default('Funcionario');
            $table->unique( array('storage_destiny_id','correlative'));
            // falta adicionar lo de la gerencia
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
        Schema::dropIfExists('article_requests');
    }
}
