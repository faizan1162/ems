<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoodlePackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'pack_title' => $this->faker->word(),
            'price' => $this->faker->numberBetween(10, 100),
            'created_by' => User::inRandomOrder()->first()->id,
            'cover_image' => $this->faker->image(public_path('assets/uploads/thumbnails'),640, 480, null, false),
            'is_admin' => 0,
            'is_active' => 1,
       ];
    }
}
