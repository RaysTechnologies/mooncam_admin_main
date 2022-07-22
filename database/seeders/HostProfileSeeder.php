<?php

namespace Database\Seeders;

use App\Models\HostProfile;
use Illuminate\Database\Seeder;

class HostProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HostProfile::factory()
            ->count(5)
            ->create();
    }
}
