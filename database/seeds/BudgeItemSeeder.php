<?php

use Illuminate\Database\Seeder;

class BudgeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('budget_items')->insert([
            'name' =>  'Partida Financiera ',
            'description' =>  'Financiera'
        ]);
    }
}
