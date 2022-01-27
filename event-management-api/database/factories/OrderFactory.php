<?php

namespace Database\Factories;

use App\Models\DoodlePack;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $doodle_pack = DoodlePack::inRandomOrder()->first();
        $admin_earnings = ($doodle_pack->price * 10 / 100);
        $artist_earnings = $doodle_pack->price - $admin_earnings;
        return [
            'doodle_pack_id' => $doodle_pack->id,
            'artist_id' => $doodle_pack->created_by,
            'user_id' => random_int(2,502),
            'pack_title' => $doodle_pack->pack_title,
            'total_amount' => $doodle_pack->price,
            'admin_earning' => $admin_earnings,
            'artist_earning' => $artist_earnings,
            'created_at' => $this->faker->dateTimeBetween('-1 years')
        ];
    }
}
