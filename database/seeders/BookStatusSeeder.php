<?php

namespace Database\Seeders;

use App\Models\Book;
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
        $bookIds = Book::pluck('id')->toArray();

        $statuses = ['READ', 'READING', 'WISH'];


        for ($i = 0; $i < 10; $i++) {
            $userId = $userIds[array_rand($userIds)];
            $bookId = $bookIds[array_rand($bookIds)];
            $status = $statuses[array_rand($statuses)];

            if ($status == 'READ'){
                BookStatus::factory()->create([
                    'id_user' => $userId,
                    'id_book' => $bookId,
                    'status' => $status,
                    'pages' => Book::find($bookId)->pages
                ]);
            } else if ($status == 'READING'){
                BookStatus::factory()->create([
                    'id_user' => $userId,
                    'id_book' => $bookId,
                    'status' => $status,
                    'pages' => rand(1, Book::find($bookId)->pages)
                ]);
            } else {
                BookStatus::factory()->create([
                    'id_user' => $userId,
                    'id_book' => $bookId,
                    'status' => $status,
                    'pages' => null
                ]);
            }

        }
    }
}
