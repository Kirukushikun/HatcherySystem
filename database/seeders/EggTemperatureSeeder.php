<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use App\Models\EggTemperature;

class EggTemperatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 60; $i++) {
            EggTemperature::create([
                'ps_no' => $faker->randomElement(['#92', '#93', '#94']),
                'setting_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'incubator' => $faker->randomElement(['1', '2', '3']),
                'location' => $faker->randomElement(['Top', 'Mid', 'Low']),
                'temperature' => $faker->randomElement(['37.8 Above', '37.7 Below']),
                'temperature_check_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'quantity' => $faker->numberBetween(400, 600),
            ]);
        }
    }
}
