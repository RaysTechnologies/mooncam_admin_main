<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\VideoCallTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoCallTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VideoCallTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reciever_id' => $this->faker->text(255),
            'sender_id' => $this->faker->text(255),
            'call_duration' => $this->faker->text(255),
            'token_charge' => $this->faker->text(255),
            'host_profile_id' => \App\Models\HostProfile::factory(),
        ];
    }
}
