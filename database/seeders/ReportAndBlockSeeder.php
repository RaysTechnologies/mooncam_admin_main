<?php

namespace Database\Seeders;

use App\Models\ReportAndBlock;
use Illuminate\Database\Seeder;

class ReportAndBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportAndBlock::factory()
            ->count(5)
            ->create();
    }
}
