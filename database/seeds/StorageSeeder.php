<?php

use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('storages')->insert([
            'name' =>  'Almacen Central ',
            'description' =>  'Almacen Princilpal'
        ]);
    }
}
