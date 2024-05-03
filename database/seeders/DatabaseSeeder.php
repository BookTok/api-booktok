<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            AuthorSeeder::class,
            PubliserSeeder::class,
            BookSeeder::class,
            FollowSeeder::class,
            FriendSeeder::class,
            BookStatusSeeder::class,
            ReviewSeeder::class,
            UserListSeeder::class,
            BookListSeeder::class
        ]);
    }
}
