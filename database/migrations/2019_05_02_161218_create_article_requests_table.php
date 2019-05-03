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
            $table->integer('storage_id');
            $table->foreign('storage_id')->references('id')->on('storages');
            $table->integer("number_reuest")->nullable();
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('public._bp_usuarios');
            $table->boolean('is_approved')->default(false);
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
