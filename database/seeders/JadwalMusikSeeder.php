<?php

namespace Database\Seeders;

use App\Models\JadwalMusik;
use Illuminate\Database\Seeder;

class JadwalMusikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($user_count, $schedule_count)
    {
        JadwalMusik::factory()->count($schedule_count)->user_count($user_count)->create();
    }
}
