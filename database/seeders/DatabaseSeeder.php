<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\JadwalMusikSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user_count = 20;
        $schedule_count = 50;

        $this->call(UserSeeder::class, false, [
            'user_count' => $user_count,
        ]);
        $this->call(JadwalMusikSeeder::class, false, [
            'user_count' => $user_count,
            'schedule_count' => $schedule_count,
        ]);
    }
}
