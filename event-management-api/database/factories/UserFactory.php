<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'utype' => 2,
            'full_name' => $this->faker->name(),
            'phone_code' => "+92",
            'phone' => $this->faker->phoneNumber(),
            'bio' => $this->faker->streetAddress(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$quvwxQtKCahI0ngiu66x9eaUBvjR7UQLSsUgrfNOfhyZNDSe9dLJ.', // password
            'is_active' => 1
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
