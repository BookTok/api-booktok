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

        for ($i = 0; $i < 10; $i++) {
            $bookId = $bookIds[array_rand($bookIds)];
            $userListId = $userListIds[array_rand($userListIds)];

            // Verificar si la entrada ya existe en la tabla book_lists
            $existingEntry = BookList::where('id_book', $bookId)->where('id_list', $userListId)->exists();

            // Si la entrada no existe, crearla
            if (!$existingEntry) {
                BookList::factory()->create([
                    'id_book' => $bookId,
                    'id_list' => $userListId,
                ]);
            }
        }
    }
}
