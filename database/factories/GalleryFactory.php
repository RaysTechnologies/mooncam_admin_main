<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'host_profile_id' => \App\Models\HostProfile::factory(),
        ];
    }
}
