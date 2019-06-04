<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('public._bp_usuarios')->insert(
            [
                'usr_usuario'=>'sys.admin',
                'password'=> bcrypt('123456'),
                'usr_controlar_ip' => 'N',
                'usr_corr_id'=>1,
                'usr_ga_id'=>1,
                'usr_usr_id'=> 1,
                'usr_estado'=>'A',

            ]
        );

        $user = User::where('usr_usuario','sys.admin')->first();
        $user->assignRole('Administrador');


    }
}
