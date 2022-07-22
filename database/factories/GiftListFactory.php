<?php

namespace Database\Factories;

use App\Models\GiftList;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class GiftListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GiftList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'token' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
