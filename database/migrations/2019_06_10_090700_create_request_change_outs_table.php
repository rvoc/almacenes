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
            $table->boolean('is_aprobed_boss')->default(false);
            $table->boolean('is_aprobed_boss2')->default(false);
            $table->string('description');
            $table->integer('article_request_id');
            $table->foreign('article_request_id')->references('id')->on('sisme.article_requests');
            $table->integer('user_id');//usuario quien aprueba o rechaza el articulo
            $table->foreign('user_id')->references('usr_id')->on('_bp_usuarios');
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
        Schema::dropIfExists('request_change_outs');
    }
}
