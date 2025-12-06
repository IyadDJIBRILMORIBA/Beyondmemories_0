<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer l'utilisateur par défaut avec ID=1 uniquement s'il n'existe pas
        if (!User::where('id', 1)->exists()) {
            User::create([
                'id' => 1,
                'name' => 'Demo User',
                'email' => 'demo@beyondmemories.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Lancer le seeder des memories
        $this->call([
            MemorySeeder::class,
        ]);
    }
}