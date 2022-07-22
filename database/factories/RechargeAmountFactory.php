<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\RechargeAmount;
use Illuminate\Database\Eloquent\Factories\Factory;

class RechargeAmountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RechargeAmount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->text(255),
            'token' => $this->faker->text(255),
            'unit' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
