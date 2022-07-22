<?php

namespace Database\Seeders;

use App\Models\GiftList;
use Illuminate\Database\Seeder;

class GiftListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GiftList::factory()
            ->count(5)
            ->create();
    }
}
