<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\EggTemperatureSeeder;
use Database\Seeders\EggCollectionSeeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // DB::table('users')->insert([
        //     'id' => 1,
        //     'password' => null,
        //     'role' => 'superuser',
        // ]);

        // Empty specific tables
        DB::table('egg_temperature')->truncate();
        DB::table('egg_collection')->truncate();

        $this->call([
            EggTemperatureSeeder::class,
            EggCollectionSeeder::class
        ]);
    }
}
