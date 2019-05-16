<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::unprepared('
        //                 CREATE TRIGGER article_incomes_relative
        //                 BEFORE INSERT ON article_incomes
        //                 $$
        //                 FOR EACH ROW
        //                 BEGIN
        //                     SET NEW.correlative = (SELECT COALESCE (MAX(correlative),0) + 1 FROM article_incomes WHERE storage_id = NEW.storage_id );
        //                 END
        //                 $$
        //               ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::unprepared('DROP TRIGGER IF EXISTS article_incomes_relative');
    }
}
