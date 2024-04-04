<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Follow;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('rol', 'REG')->pluck('id')->toArray();
        $authorIds = Author::pluck('id')->toArray();
        $publisherIds = Publisher::pluck('id')->toArray();

        // Generar datos aleatorios
        for ($i = 0; $i < 10; $i++) {
            Follow::factory()->create([
                'id_user' => $userIds[array_rand($userIds)],
                'id_author' => $authorIds[array_rand($authorIds)],
                'id_publisher' => $publisherIds[array_rand($publisherIds)],
            ]);
        }
    }
}
