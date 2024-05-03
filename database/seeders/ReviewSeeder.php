<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookStatus;
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

        // Obtener todos los usuarios REG
        $regularUsers = User::where('rol', 'REG')->pluck('id')->toArray();

        foreach ($regularUsers as $userId) {
            // Obtener todos los libros en estado READ para este usuario
            $readBooks = BookStatus::where('id_user', $userId)
                ->where('status', 'READ')
                ->pluck('id_book')
                ->toArray();

            // Crear una reseña para cada libro en estado READ
            foreach ($readBooks as $bookId) {
                Review::factory()->create([
                    'id_book' => $bookId,
                    'id_user' => $userId,
                ]);
            }
        }
    }
}
