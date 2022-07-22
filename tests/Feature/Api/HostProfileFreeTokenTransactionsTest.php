<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\HostProfile;
use App\Models\FreeTokenTransaction;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HostProfileFreeTokenTransactionsTest extends TestCase
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
    public function it_gets_host_profile_free_token_transactions()
    {
        $hostProfile = HostProfile::factory()->create();
        $freeTokenTransactions = FreeTokenTransaction::factory()
            ->count(2)
            ->create([
                'host_profile_id' => $hostProfile->id,
            ]);

        $response = $this->getJson(
            route(
                'api.host-profiles.free-token-transactions.index',
                $hostProfile
            )
        );

        $response->assertOk()->assertSee($freeTokenTransactions[0]->free_token);
    }

    /**
     * @test
     */
    public function it_stores_the_host_profile_free_token_transactions()
    {
        $hostProfile = HostProfile::factory()->create();
        $data = FreeTokenTransaction::factory()
            ->make([
                'host_profile_id' => $hostProfile->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.host-profiles.free-token-transactions.store',
                $hostProfile
            ),
            $data
        );

        $this->assertDatabaseHas('free_token_transactions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $freeTokenTransaction = FreeTokenTransaction::latest('id')->first();

        $this->assertEquals(
            $hostProfile->id,
            $freeTokenTransaction->host_profile_id
        );
    }
}
