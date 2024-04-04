<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('rol', 'REG')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $userId = $userIds[array_rand($userIds)];
            UserList::factory()->create([
                'id_user' => $userId
            ]);
        }

    }
}
