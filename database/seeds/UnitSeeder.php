<?php

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sisme.units')->insert([
            'name' =>  'caja',
            'short_name' =>  'caja'
        ]);
        DB::table('sisme.units')->insert([
            'name' =>  'litros',
            'short_name' =>  'lt'
        ]);
    }
}
