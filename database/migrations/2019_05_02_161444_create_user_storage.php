<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStorage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sisme.user_storage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('storage_id');
            $table->foreign('storage_id')->references('id')->on('sisme.storages');
            $table->integer('user_usr_id');
            $table->foreign('user_usr_id')->references('usr_id')->on('_bp_usuarios');
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
        Schema::dropIfExists('sisme.user_storage');
    }
}
