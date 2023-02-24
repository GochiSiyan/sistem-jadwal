<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalMusikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition($user_count = 10)
    {
        return [
            'room' => $this->faker->randomElement([0, 1, 2, 3]),
            'from' => $this->faker->dateTimeThisMonth(),
            'length' => $this->faker->time(),
        ];
    }

    public function user_count($user_count)
    {
        return $this->state(function (array $attributes) use ($user_count) {
            return [
                'teacher_id' => $this->faker->numberBetween(1, $user_count),
                'student_id' => $this->faker->numberBetween(1, $user_count),
            ];
        });
    }
}
