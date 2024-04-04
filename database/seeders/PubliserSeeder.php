<?php

namespace Database\Seeders;

use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PubliserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $user = User::factory()->create([
                'rol' => 'EDI'
            ]);
            Publisher::factory()->create([
                'id_user' =>  $user->id
            ]);
        }
    }
}
