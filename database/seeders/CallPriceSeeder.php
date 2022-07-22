<?php

namespace Database\Seeders;

use App\Models\CallPrice;
use Illuminate\Database\Seeder;

class CallPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CallPrice::factory()
            ->count(5)
            ->create();
    }
}
