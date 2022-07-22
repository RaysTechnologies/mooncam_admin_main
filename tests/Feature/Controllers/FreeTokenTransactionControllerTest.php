<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\FreeTokenTransaction;

use App\Models\HostProfile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FreeTokenTransactionControllerTest extends TestCase
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
    public function it_displays_index_view_with_free_token_transactions()
    {
        $freeTokenTransactions = FreeTokenTransaction::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('free-token-transactions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.free_token_transactions.index')
            ->assertViewHas('freeTokenTransactions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_free_token_transaction()
    {
        $response = $this->get(route('free-token-transactions.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.free_token_transactions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_free_token_transaction()
    {
        $data = FreeTokenTransaction::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('free-token-transactions.store'), $data);

        $this->assertDatabaseHas('free_token_transactions', $data);

        $freeTokenTransaction = FreeTokenTransaction::latest('id')->first();

        $response->assertRedirect(
            route('free-token-transactions.edit', $freeTokenTransaction)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_free_token_transaction()
    {
        $freeTokenTransaction = FreeTokenTransaction::factory()->create();

        $response = $this->get(
            route('free-token-transactions.show', $freeTokenTransaction)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.free_token_transactions.show')
            ->assertViewHas('freeTokenTransaction');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_free_token_transaction()
    {
        $freeTokenTransaction = FreeTokenTransaction::factory()->create();

        $response = $this->get(
            route('free-token-transactions.edit', $freeTokenTransaction)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.free_token_transactions.edit')
            ->assertViewHas('freeTokenTransaction');
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

        $response = $this->put(
            route('free-token-transactions.update', $freeTokenTransaction),
            $data
        );

        $data['id'] = $freeTokenTransaction->id;

        $this->assertDatabaseHas('free_token_transactions', $data);

        $response->assertRedirect(
            route('free-token-transactions.edit', $freeTokenTransaction)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_free_token_transaction()
    {
        $freeTokenTransaction = FreeTokenTransaction::factory()->create();

        $response = $this->delete(
            route('free-token-transactions.destroy', $freeTokenTransaction)
        );

        $response->assertRedirect(route('free-token-transactions.index'));

        $this->assertModelMissing($freeTokenTransaction);
    }
}
