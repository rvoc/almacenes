<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'name' =>  'hojas',
            'description' =>  'Hojas de todo tipo'
        ]);
        DB::table('categories')->insert([
            'name' =>  'cuadernos',
            'description' =>  'cuaderno anillados XD'
        ]);
    }
}
