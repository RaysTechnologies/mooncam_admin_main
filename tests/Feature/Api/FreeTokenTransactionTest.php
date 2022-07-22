<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\FreeTokenTransaction;

use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FreeTokenTransactionTest extends TestCase
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
    public function it_gets_free_token_transactions_list()
    {
        $freeTokenTransactions = FreeTokenTransaction::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.free-token-transactions.index'));

        $response->assertOk()->assertSee($freeTokenTransactions[0]->free_token);
    }

    /**
     * @test
     */
    public function it_stores_the_free_token_transaction()
    {
        $data = FreeTokenTransaction::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.free-token-transactions.store'),
            $data
        );

        $this->assertDatabaseHas('free_token_transactions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_free_token_transaction()
    {
        $freeTokenTransaction = FreeTokenTransaction::factory()->create();

        $hostProfile = HostProfile::factory()->create();

        $data = [
            'free_token' => $this->faker->text(255),
            'host_profile_id' => $hostProfile->id,
        ];

        $response = $this->putJson(
            route('api.free-token-transactions.update', $freeTokenTransaction),
            $data
        );

        $data['id'] = $freeTokenTransaction->id;

        $this->assertDatabaseHas('free_token_transactions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_free_token_transaction()
    {
        $freeTokenTransaction = FreeTokenTransaction::factory()->create();

        $response = $this->deleteJson(
            route('api.free-token-transactions.destroy', $freeTokenTransaction)
        );

        $this->assertModelMissing($freeTokenTransaction);

        $response->assertNoContent();
    }
}
