<?php

namespace Database\Seeders;

use App\Models\CountryList;
use Illuminate\Database\Seeder;

class CountryListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CountryList::factory()
            ->count(5)
            ->create();
    }
}
