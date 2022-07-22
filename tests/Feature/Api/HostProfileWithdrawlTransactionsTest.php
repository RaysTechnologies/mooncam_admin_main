<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\HostProfile;
use App\Models\WithdrawlTransaction;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HostProfileWithdrawlTransactionsTest extends TestCase
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
    public function it_gets_host_profile_withdrawl_transactions()
    {
        $hostProfile = HostProfile::factory()->create();
        $withdrawlTransactions = WithdrawlTransaction::factory()
            ->count(2)
            ->create([
                'host_profile_id' => $hostProfile->id,
            ]);

        $response = $this->getJson(
            route(
                'api.host-profiles.withdrawl-transactions.index',
                $hostProfile
            )
        );

        $response->assertOk()->assertSee($withdrawlTransactions[0]->token);
    }

    /**
     * @test
     */
    public function it_stores_the_host_profile_withdrawl_transactions()
    {
        $hostProfile = HostProfile::factory()->create();
        $data = WithdrawlTransaction::factory()
            ->make([
                'host_profile_id' => $hostProfile->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.host-profiles.withdrawl-transactions.store',
                $hostProfile
            ),
            $data
        );

        $this->assertDatabaseHas('withdrawl_transactions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $withdrawlTransaction = WithdrawlTransaction::latest('id')->first();

        $this->assertEquals(
            $hostProfile->id,
            $withdrawlTransaction->host_profile_id
        );
    }
}
