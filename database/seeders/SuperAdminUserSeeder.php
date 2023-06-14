<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@gudangku.com',
            'name' => 'Admin Gudangku',
            'address' => 'Medan',
            'email_verified_at' => now(),
            'password' => bcrypt('gudangku123'),
            'role' => 'admin',
        ]);
    }
}
