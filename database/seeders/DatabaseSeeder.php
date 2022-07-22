<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(AmountConversionSeeder::class);
        $this->call(BankDetailsSeeder::class);
        $this->call(CallPriceSeeder::class);
        $this->call(CountryListSeeder::class);
        $this->call(FreeTokenTransactionSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(GiftListSeeder::class);
        $this->call(GiftTransactionSeeder::class);
        $this->call(HostProfileSeeder::class);
        $this->call(RechargeAmountSeeder::class);
        $this->call(ReportAndBlockSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(VideoCallTransactionSeeder::class);
        $this->call(WalletSeeder::class);
        $this->call(WithdrawlTransactionSeeder::class);
    }
}
