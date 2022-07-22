<?php

namespace Database\Factories;

use App\Models\CallPrice;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CallPriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CallPrice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'video_call' => $this->faker->text(255),
            'live_streaming' => $this->faker->text(255),
            'video_call_price_limit' => $this->faker->text(255),
            'live_streaming_call_price_limit' => $this->faker->text(255),
            'photo_price' => $this->faker->text(255),
            'host_profile_id' => \App\Models\HostProfile::factory(),
        ];
    }
}
