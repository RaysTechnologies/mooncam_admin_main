<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\HostProfile;
use App\Models\GiftTransaction;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HostProfileGiftTransactionsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_host_profile_gift_transactions()
    {
        $hostProfile = HostProfile::factory()->create();
        $giftTransactions = GiftTransaction::factory()
            ->count(2)
            ->create([
                'host_profile_id' => $hostProfile->id,
            ]);

        $response = $this->getJson(
            route('api.host-profiles.gift-transactions.index', $hostProfile)
        );

        $response->assertOk()->assertSee($giftTransactions[0]->reciever_id);
    }

    /**
     * @test
     */
    public function it_stores_the_host_profile_gift_transactions()
    {
        $hostProfile = HostProfile::factory()->create();
        $data = GiftTransaction::factory()
            ->make([
                'host_profile_id' => $hostProfile->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.host-profiles.gift-transactions.store', $hostProfile),
            $data
        );

        $this->assertDatabaseHas('gift_transactions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $giftTransaction = GiftTransaction::latest('id')->first();

        $this->assertEquals(
            $hostProfile->id,
            $giftTransaction->host_profile_id
        );
    }
}
