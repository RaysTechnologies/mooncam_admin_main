<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\AmountConversion;
use Illuminate\Database\Eloquent\Factories\Factory;

class AmountConversionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AmountConversion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'token' => $this->faker->text(255),
            'amount' => $this->faker->text(255),
            'unit' => $this->faker->text(255),
            'symbol' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
