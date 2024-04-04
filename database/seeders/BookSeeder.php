<?php

namespace Database\Seeders;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Publishers;
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
        $authorIds = Authors::pluck('id')->toArray();
        $publisherIds = Publishers::pluck('id')->toArray();
        for ($i = 0; $i < 10; $i++) {
            Books::factory()->create([
                'id_author' => $faker->randomElement($authorIds),
                'id_publisher' => $faker->randomElement($publisherIds),
                'sales' => $faker->randomElement(['AMAZ', 'CASA_LIBRO', 'FNAC', 'CORTE_INGLES']),
                'genres'=> $faker->randomElement(['FIC', 'NO_FIC', 'POE', 'TEA', 'INF', 'OTROS'])
            ]);
        }
    }
}
