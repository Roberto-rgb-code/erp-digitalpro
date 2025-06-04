<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@erp.com'],
            ['name' => 'Admin', 'password' => bcrypt('admin123')]
        );
    }
}
