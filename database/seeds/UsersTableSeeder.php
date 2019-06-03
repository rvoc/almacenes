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

        DB::table('sisme.users')->insert([
            'username' =>  'admin',
            'name' =>  'admin',
            // 'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'Encargado Alamcen']);
        $role = Role::create(['name' => 'Usuario General']);

        $user = User::find(1);
        $user->assignRole('Admin');
    }
}
