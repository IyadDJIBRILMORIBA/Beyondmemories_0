<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer l'utilisateur par défaut uniquement s'il n'existe pas
        User::firstOrCreate(
            ['email' => 'demo@beyondmemories.com'],
            [
                'name' => 'Demo User',
                'password' => bcrypt('password'),
            ]
        );

        // Lancer le seeder des memories
        $this->call([
            MemorySeeder::class,
        ]);
    }
}