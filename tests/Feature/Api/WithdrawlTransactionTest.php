<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WithdrawlTransaction;

use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WithdrawlTransactionTest extends TestCase
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
    public function it_gets_withdrawl_transactions_list()
    {
        $withdrawlTransactions = WithdrawlTransaction::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.withdrawl-transactions.index'));

        $response->assertOk()->assertSee($withdrawlTransactions[0]->token);
    }

    /**
     * @test
     */
    public function it_stores_the_withdrawl_transaction()
    {
        $data = WithdrawlTransaction::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.withdrawl-transactions.store'),
            $data
        );

        $this->assertDatabaseHas('withdrawl_transactions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_withdrawl_transaction()
    {
        $withdrawlTransaction = WithdrawlTransaction::factory()->create();

        $hostProfile = HostProfile::factory()->create();

        $data = [
            'token' => $this->faker->text(255),
            'total_amount' => $this->faker->text(255),
            'recieved_amount' => $this->faker->text(255),
            'commision' => $this->faker->text(255),
            'status' => $this->faker->word,
            'date' => $this->faker->date,
            'host_profile_id' => $hostProfile->id,
        ];

        $response = $this->putJson(
            route('api.withdrawl-transactions.update', $withdrawlTransaction),
            $data
        );

        $data['id'] = $withdrawlTransaction->id;

        $this->assertDatabaseHas('withdrawl_transactions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_withdrawl_transaction()
    {
        $withdrawlTransaction = WithdrawlTransaction::factory()->create();

        $response = $this->deleteJson(
            route('api.withdrawl-transactions.destroy', $withdrawlTransaction)
        );

        $this->assertModelMissing($withdrawlTransaction);

        $response->assertNoContent();
    }
}
