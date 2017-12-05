<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(AdminSeeder::class);
        \Artisan::call('passport:client', [
        '--password' => true,
        '-n'    => true,
        ]);
        $this->call(ProviderSeeder::class);
        // $this->call(UsersSeeder::class);
    }
}
