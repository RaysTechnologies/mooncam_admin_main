<?php

namespace Database\Factories;

use App\Models\HostProfile;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HostProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'age' => $this->faker->text(255),
            'mobile' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'gender' => $this->faker->text(255),
            'fans_count' => $this->faker->text(255),
            'followup_count' => $this->faker->text(255),
            'visitor_count' => $this->faker->text(255),
            'firebase_id' => $this->faker->text(255),
            'token_rate_videocall' => $this->faker->text(255),
            'token_rate_groupcall' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
