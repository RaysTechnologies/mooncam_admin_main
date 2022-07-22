<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoCallTransaction;

class VideoCallTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoCallTransaction::factory()
            ->count(5)
            ->create();
    }
}
