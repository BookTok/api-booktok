<?php

namespace Database\Seeders;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regularUserIds = User::where('rol', 'REG')->pluck('id')->toArray();

        for ($i = 0; $i < 5; $i++) {
            $userId = $regularUserIds[array_rand($regularUserIds)];
            $friendId = $regularUserIds[array_rand($regularUserIds)];

            while ($userId === $friendId || Friend::where('id_user', $userId)->where('id_friend', $friendId)->exists()) {
                $friendId = $regularUserIds[array_rand($regularUserIds)];
            }

            Friend::factory()->create([
                'id_user' => $userId,
                'id_friend' => $friendId,
            ]);
        }
    }
}
