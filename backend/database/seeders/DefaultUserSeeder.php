<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer l'utilisateur par défaut si il n'existe pas
        if (!User::where('id', 1)->exists()) {
            User::create([
                'id' => 1,
                'name' => 'Default User',
                'email' => 'user@beyondmemories.app',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
