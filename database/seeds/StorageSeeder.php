<?php

use Illuminate\Database\Seeder;
use App\User;
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
        DB::table('sisme.storages')->insert([
            'name' =>  'Almacen Central ',
            'description' =>  'Almacen Princilpal'
        ]);


        $user = User::where('usr_usuario','sys.admin')->first();
        $user->storages()->sync([1]);

    }
}
