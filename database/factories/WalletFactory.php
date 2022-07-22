<?php

namespace Database\Factories;

use App\Models\Wallet;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'token' => $this->faker->text(255),
            'free_token' => $this->faker->text(255),
            'host_profile_id' => \App\Models\HostProfile::factory(),
        ];
    }
}
