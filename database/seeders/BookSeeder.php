<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $authorIds = Author::pluck('id')->toArray();
        $publisherIds = Publisher::pluck('id')->toArray();
        for ($i = 0; $i < 10; $i++) {
            Book::factory()->create([
                'id_author' => $faker->randomElement($authorIds),
                'id_publisher' => $faker->randomElement($publisherIds),
                'sales' => $faker->randomElement(['AMAZ', 'CASA_LIBRO', 'FNAC', 'CORTE_INGLES']),
                'genres'=> $faker->randomElement(['FIC', 'NO_FIC', 'POE', 'TEA', 'INF', 'OTROS'])
            ]);
        }
    }
}
