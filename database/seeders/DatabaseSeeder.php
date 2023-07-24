<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Epel',
            'email' => 'epel@example.com',
            'password' => '12345678',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        User::factory(5)->create();
        Article::factory(15)->create();
        Category::factory(15)->create();
    }
}
