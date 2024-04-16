<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $regularUsers = User::where('rol', 'REG')->pluck('id')->toArray();
        $books = Book::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $randomUserId = $regularUsers[array_rand($regularUsers)];
            $randomBookId = $books[array_rand($books)];
            Review::factory()->create([
                'id_book' => $randomBookId,
                'id_user' => $randomUserId,
            ]);
        }
    }
}