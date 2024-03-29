<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestChangeOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sisme.request_change_outs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['Eliminacion', 'Modificacion' ])->default('Modificacion');
            $table->enum('state', ['Aprobado', 'Rechazado','Pendiente','Pendiente Aprobacion'])->default('Pendiente Aprobacion');
            $table->string('description');
            $table->integer('article_request_id');
            $table->foreign('article_request_id')->references('id')->on('sisme.article_requests');
            $table->integer('user_id');//usuario quien aprueba o rechaza el articulo
            $table->foreign('user_id')->references('usr_id')->on('_bp_usuarios');
            $table->integer('storage_id');//para  diferenciarlos por sucursal
            $table->foreign('storage_id')->references('id')->on('sisme.storages');
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
        Schema::dropIfExists('sisme.request_change_outs');
    }
}
