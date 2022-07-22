<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AmountConversion;

class AmountConversionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AmountConversion::factory()
            ->count(5)
            ->create();
    }
}
