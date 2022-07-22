<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WithdrawlTransaction;

class WithdrawlTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WithdrawlTransaction::factory()
            ->count(5)
            ->create();
    }
}
