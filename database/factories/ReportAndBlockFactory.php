<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ReportAndBlock;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportAndBlockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ReportAndBlock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'blocked_user_id' => $this->faker->text(255),
            'blocked_user_name' => $this->faker->text(255),
            'host_profile_id' => \App\Models\HostProfile::factory(),
        ];
    }
}
