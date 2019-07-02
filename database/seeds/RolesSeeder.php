<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permission = Permission::create(['name' => 'POA']);
        $permission = Permission::create(['name' => 'SAE']);
        $permission = Permission::where('name','SAE')->first();
        $role = Role::create(['name' => 'Administrador']);
        $role->givePermissionTo($permission);
        $role = Role::create(['name' => 'Encargado de Almacen']);
        $role->givePermissionTo($permission);
        $role = Role::create(['name' => 'Encargado de Oficina Central']);
        $role->givePermissionTo($permission);
        $role = Role::create(['name' => 'Funcionario']);
        $role->givePermissionTo($permission);
        $role = Role::create(['name' => 'Jefe de Planta']);
        $role->givePermissionTo($permission);

    }
}
