<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($user_count = 10)
    {
        if ($user_count > 1) User::factory($user_count - 1)->create();
    }
}
