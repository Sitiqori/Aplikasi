<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(CategorySeeder::class);

        User::create([
            'username' => 'admin',
            'name' => 'admin',
            'slug' => 'admin',
            'password' => bcrypt('rahasia'),
            'email' => 'admin@gmail.com',
            'address' => 'address test',
            'status' => 'active',
            'role_id' => 1
        ]);

        User::create([
            'username' => 'petugas',
            'name' => 'petugas',
            'slug' => 'petugas',
            'password' => bcrypt('rahasia'),
            'email' => 'petugas@gmail.com',
            'address' => 'address test',
            'status' => 'active',
            'role_id' => 2
        ]);

        User::create([
            'username' => 'client',
            'name' => 'client',
            'slug' => 'client',
            'password' => bcrypt('rahasia'),
            'email' => 'client@gmail.com',
            'address' => 'address test',
            'status' => 'active',
            'role_id' => 3
        ]);
    }
}
