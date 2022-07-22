<?php

namespace Database\Seeders;

use App\Models\RechargeAmount;
use Illuminate\Database\Seeder;

class RechargeAmountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RechargeAmount::factory()
            ->count(5)
            ->create();
    }
}
