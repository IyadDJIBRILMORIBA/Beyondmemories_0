<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Memory;
use App\Models\Parcel;
use Illuminate\Support\Facades\Storage;

class MemorySeeder extends Seeder
{
    public function run(): void
    {
        // Créer le répertoire storage/app/public/memories si nécessaire
        if (!Storage::disk('public')->exists('memories')) {
            Storage::disk('public')->makeDirectory('memories');
        }

        // Créer quelques souvenirs de test avec des images placeholder
        $memories = [
            [
                'path' => 'memories/demo1.jpg',
                'type' => 'image',
                'taken_at' => '1950-06-15',
                'is_featured' => true,
            ],
            [
                'path' => 'memories/demo2.jpg',
                'type' => 'image',
                'taken_at' => '1975-08-22',
                'is_featured' => true,
            ],
            [
                'path' => 'memories/demo3.jpg',
                'type' => 'image',
                'taken_at' => '1990-12-10',
                'is_featured' => true,
            ],
            [
                'path' => 'memories/demo4.jpg',
                'type' => 'image',
                'taken_at' => '2005-03-18',
                'is_featured' => false,
            ],
            [
                'path' => 'memories/demo5.jpg',
                'type' => 'image',
                'taken_at' => '2020-07-25',
                'is_featured' => true,
            ],
        ];

        foreach ($memories as $memory) {
            // Créer une image placeholder minimale (1x1 pixel PNG transparent)
            $placeholderPng = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==');
            Storage::disk('public')->put($memory['path'], $placeholderPng);
            
            Memory::create(array_merge($memory, ['user_id' => 1]));
        }

        // Créer une parcelle exemple
        Parcel::create([
            'user_id' => 1,
            'template_id' => 1,
            'name' => 'Mémorial de Grand-mère Marie',
        ]);

        $this->command->info('✅ 5 memories et 1 parcelle créées !');
    }
}