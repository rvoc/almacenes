<?php

use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('providers')->insert([
            'name' =>  'David Corp ',
            'address' =>  'villa adela',
            'phone' =>  '22831015',
            'first_name' =>  'Leandro David',
            'last_name' =>  'Torrez',
            'mother_last_name' =>  'Salinas',
            'cellphone' =>  '70620481'
        ]);
    }
}
