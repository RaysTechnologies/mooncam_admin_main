<?php

namespace Database\Seeders;

use App\Models\BankDetails;
use Illuminate\Database\Seeder;

class BankDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankDetails::factory()
            ->count(5)
            ->create();
    }
}
