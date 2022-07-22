<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\GiftTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class GiftTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GiftTransaction::class;

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
            'gift_id' => $this->faker->text(255),
            'gift_name' => $this->faker->text(255),
            'token' => $this->faker->text(255),
            'host_profile_id' => \App\Models\HostProfile::factory(),
        ];
    }
}
