<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RolesTableSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(NeighborhoodSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(TipoDeImovelSeeder::class);

        $admin = \App\Models\User::updateOrInsert([
            'email' => 'Administrator@mproperty.com',
        ], [
            'name' => 'Administrator',
            'email' => 'Administrator@mproperty.com',
            'email_verified_at' => now(),
            'password' => Hash::make('#mproperty@2021@project#'), // password
            'remember_token' => '92IXUNpkjO0rOQ5byMi',
        ]);
        $admin->assignRole('Super-Admin');
    }
}
