<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\GiftTransaction;

use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GiftTransactionTest extends TestCase
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
    public function it_gets_gift_transactions_list()
    {
        $giftTransactions = GiftTransaction::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.gift-transactions.index'));

        $response->assertOk()->assertSee($giftTransactions[0]->reciever_id);
    }

    /**
     * @test
     */
    public function it_stores_the_gift_transaction()
    {
        $data = GiftTransaction::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.gift-transactions.store'),
            $data
        );

        $this->assertDatabaseHas('gift_transactions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_gift_transaction()
    {
        $giftTransaction = GiftTransaction::factory()->create();

        $hostProfile = HostProfile::factory()->create();

        $data = [
            'reciever_id' => $this->faker->text(255),
            'sender_id' => $this->faker->text(255),
            'gift_id' => $this->faker->text(255),
            'gift_name' => $this->faker->text(255),
            'token' => $this->faker->text(255),
            'host_profile_id' => $hostProfile->id,
        ];

        $response = $this->putJson(
            route('api.gift-transactions.update', $giftTransaction),
            $data
        );

        $data['id'] = $giftTransaction->id;

        $this->assertDatabaseHas('gift_transactions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_gift_transaction()
    {
        $giftTransaction = GiftTransaction::factory()->create();

        $response = $this->deleteJson(
            route('api.gift-transactions.destroy', $giftTransaction)
        );

        $this->assertModelMissing($giftTransaction);

        $response->assertNoContent();
    }
}
