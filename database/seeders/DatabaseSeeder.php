<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'username' => 'admin',
            'email' => 'admin@ieq.com',
            'password' => Hash::make('Adm5eWuWyNYTarY'),
            'is_admin' => true, // O pulo do gato
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Sergio Obalski Filho',
            'username' => 'serginhobalski',
            'email' => 'serginhobalski@gmail.com',
            'password' => Hash::make('123456789'),
            'is_admin' => true, // O pulo do gato
        ]);

        $this->call(DepartmentSeeder::class);
        $this->call(MembersSeeder::class);
    }
}