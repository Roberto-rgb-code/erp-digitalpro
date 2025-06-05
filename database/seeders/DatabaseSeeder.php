<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(TipoClienteSeeder::class); // This is the line you needed to add!
        $this->call(EstadoVentaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EmpleadoSeeder::class);



    }
}