<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RejectedHatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        $faker = Faker::create();

        for ($i = 0; $i < 60; $i++) {
            DB::table('rejected_hatch')->insert([
                'ps_no' => $faker->randomElement(['92', '93', '94']),
                'production_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'set_eggs_qty' => $faker->numberBetween(400, 600),
                'incubator_no' => '1',
                'hatcher_no' => '1',
                'rejected_hatch_data' => json_encode([
                    'unhatched' => ['qty' => 50, 'percentage' => 10.0],
                    'pips' => ['qty' => 20, 'percentage' => 4.0],
                    'rejected_chicks' => ['qty' => 15, 'percentage' => 3.0],
                    'dead_chicks' => ['qty' => 10, 'percentage' => 2.0],
                    'rotten' => ['qty' => 5, 'percentage' => 1.0],
                ]),
                'pullout_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'hatch_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'rejected_total' => 100,
                'rejected_total_percentage' => 20.0,
            ]);
        }
    }
}
