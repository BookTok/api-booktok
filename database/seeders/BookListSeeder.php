<?php

namespace Database\Seeders;

use App\Models\BookList;
use App\Models\Book;
use App\Models\UserList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookIds = Book::pluck('id')->toArray();
        $userListIds = UserList::pluck('id')->toArray();

        $bookLists = [];

        for ($i = 0; $i < 10; $i++) {
            $bookId = $bookIds[array_rand($bookIds)];
            $userListId = $userListIds[array_rand($userListIds)];

            BookList::factory()->create([
                'id_book' => $bookId,
                'id_list' => $userListId,
            ]);
        }
    }
}
