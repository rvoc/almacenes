<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sisme.providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("address");
            $table->string("phone");//proveedor
            $table->string("first_name");//nombre
            $table->string("last_name");//apellido paterno
            $table->string("mother_last_name");//apellido materno
            $table->string("cellphone");
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
        Schema::dropIfExists('sisme.providers');
    }
}
