<?php

namespace Database\Seeders;
use App\Models\City;
use App\Models\Category;
use App\Models\Place;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }


    public function run(): void
    {
        // Cities
        City::insert([
            ['id' => 1, 'name' => 'Kathmandu'],
            ['id' => 2, 'name' => 'Bhaktapur'],
            ['id' => 3, 'name' => 'Lalitpur'],
        ]);

        // Categories
        Category::insert([
            ['id' => 1, 'name' => 'Temple'],
            ['id' => 2, 'name' => 'Restaurant & Cafe'],
            ['id' => 3, 'name' => 'Heritage'],
        ]);

        // Places (REAL DATA)
        Place::insert([
            [
                'name' => 'Swayambhunath Stupa',
                'description' => 'Famous Monkey Temple',
                'latitude' => 27.7149,
                'longitude' => 85.2900,
                'city_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Pashupatinath Temple',
                'description' => 'Sacred Hindu temple',
                'latitude' => 27.7104,
                'longitude' => 85.3488,
                'city_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Boudhanath Stupa',
                'description' => 'Large Buddhist stupa',
                'latitude' => 27.7215,
                'longitude' => 85.3620,
                'city_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Kathmandu Durbar Square',
                'description' => 'Historic royal palace area',
                'latitude' => 27.7049,
                'longitude' => 85.3075,
                'city_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Himalayan Java Coffee',
                'description' => 'Popular cafe',
                'latitude' => 27.7172,
                'longitude' => 85.3240,
                'city_id' => 1,
                'category_id' => 2
            ]
        ]);
    }
}
