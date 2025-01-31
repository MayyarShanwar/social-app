<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//we use factory to initiate some dummy data to our database and we use seeder to create that data and added it to tha data base

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Post::factory(2)->create();
    }
}
