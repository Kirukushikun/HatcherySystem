<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use App\Models\EggCollection;

class EggCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 60; $i++) {
            EggCollection::create([
                'ps_no' => $faker->randomElement(['93', '95', '98']),
                'house_no' => $faker->randomElement(['1', '2', '3']),
                'production_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'collection_time' => $faker->time('H:i:s'),
                'collected_qty' => $faker->numberBetween(5000, 6000),
            ]);
        }
    }
}
