<?php

namespace Database\Seeders;

use App\Models\Books;
use App\Models\BookStatus;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::where('rol', 'REG')->pluck('id')->toArray();
        $bookIds = Books::pluck('id')->toArray();

        $statuses = ['READ', 'READING', 'WISH'];


        for ($i = 0; $i < 10; $i++) {
            $userId = $userIds[array_rand($userIds)];
            $bookId = $bookIds[array_rand($bookIds)];
            $status = $statuses[array_rand($statuses)];

            BookStatus::factory()->create([
                'id_user' => $userId,
                'id_book' => $bookId,
                'status' => $status,
            ]);
        }
    }
}
