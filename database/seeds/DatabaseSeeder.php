<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(RolesSeeder::class);
        // $this->call(UsersTableSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(BudgeItemSeeder::class);
        $this->call(StorageSeeder::class);
        $this->call(ProviderSeeder::class);
    }
}
