<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $user = User::factory()->create([
                'rol' => 'AUT'
            ]);
            Author::factory()->create([
                'id_user' =>  $user->id
            ]);
        }
    }
}
