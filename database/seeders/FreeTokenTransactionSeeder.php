<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FreeTokenTransaction;

class FreeTokenTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FreeTokenTransaction::factory()
            ->count(5)
            ->create();
    }
}
