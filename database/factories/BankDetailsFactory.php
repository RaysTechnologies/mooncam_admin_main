<?php

namespace Database\Factories;

use App\Models\BankDetails;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BankDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country' => $this->faker->country,
            'host_profile_id' => \App\Models\HostProfile::factory(),
        ];
    }
}
