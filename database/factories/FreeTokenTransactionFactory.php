<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\FreeTokenTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class FreeTokenTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FreeTokenTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'free_token' => $this->faker->text(255),
            'host_profile_id' => \App\Models\HostProfile::factory(),
        ];
    }
}
