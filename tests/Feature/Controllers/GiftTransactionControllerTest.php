<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\GiftTransaction;

use App\Models\HostProfile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GiftTransactionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_gift_transactions()
    {
        $giftTransactions = GiftTransaction::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('gift-transactions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.gift_transactions.index')
            ->assertViewHas('giftTransactions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_gift_transaction()
    {
        $response = $this->get(route('gift-transactions.create'));

        $response->assertOk()->assertViewIs('app.gift_transactions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_gift_transaction()
    {
        $data = GiftTransaction::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('gift-transactions.store'), $data);

        $this->assertDatabaseHas('gift_transactions', $data);

        $giftTransaction = GiftTransaction::latest('id')->first();

        $response->assertRedirect(
            route('gift-transactions.edit', $giftTransaction)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_gift_transaction()
    {
        $giftTransaction = GiftTransaction::factory()->create();

        $response = $this->get(
            route('gift-transactions.show', $giftTransaction)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.gift_transactions.show')
            ->assertViewHas('giftTransaction');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_gift_transaction()
    {
        $giftTransaction = GiftTransaction::factory()->create();

        $response = $this->get(
            route('gift-transactions.edit', $giftTransaction)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.gift_transactions.edit')
            ->assertViewHas('giftTransaction');
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

        $response = $this->put(
            route('gift-transactions.update', $giftTransaction),
            $data
        );

        $data['id'] = $giftTransaction->id;

        $this->assertDatabaseHas('gift_transactions', $data);

        $response->assertRedirect(
            route('gift-transactions.edit', $giftTransaction)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_gift_transaction()
    {
        $giftTransaction = GiftTransaction::factory()->create();

        $response = $this->delete(
            route('gift-transactions.destroy', $giftTransaction)
        );

        $response->assertRedirect(route('gift-transactions.index'));

        $this->assertModelMissing($giftTransaction);
    }
}
