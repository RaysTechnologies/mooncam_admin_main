<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\WithdrawlTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class WithdrawlTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WithdrawlTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'token' => $this->faker->text(255),
            'total_amount' => $this->faker->text(255),
            'recieved_amount' => $this->faker->text(255),
            'commision' => $this->faker->text(255),
            'status' => $this->faker->word,
            'date' => $this->faker->date,
            'host_profile_id' => \App\Models\HostProfile::factory(),
        ];
    }
}
