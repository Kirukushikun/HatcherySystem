<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RejectedHatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rejected_hatch')->insert([
            'ps_no' => 'PS-001',
            'production_date' => now()->subDays(7), // 7 days ago
            'set_eggs_qty' => 500,
            'incubator_no' => '1',
            'hatcher_no' => '1',
            'rejected_hatch_data' => json_encode([
                'unhatched' => ['qty' => 50, 'percentage' => 10.0],
                'pips' => ['qty' => 20, 'percentage' => 4.0],
                'rejected_chicks' => ['qty' => 15, 'percentage' => 3.0],
                'dead_chicks' => ['qty' => 10, 'percentage' => 2.0],
                'rotten' => ['qty' => 5, 'percentage' => 1.0],
            ]),
            'pullout_date' => now()->subDays(1), // 1 day ago
            'hatch_date' => now()->subDays(2), // 2 days ago
            'rejected_total' => 100,
            'rejected_total_percentage' => 20.0,
        ]);
    }
}
