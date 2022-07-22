<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WithdrawlTransaction;

use App\Models\HostProfile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WithdrawlTransactionControllerTest extends TestCase
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
    public function it_displays_index_view_with_withdrawl_transactions()
    {
        $withdrawlTransactions = WithdrawlTransaction::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('withdrawl-transactions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.withdrawl_transactions.index')
            ->assertViewHas('withdrawlTransactions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_withdrawl_transaction()
    {
        $response = $this->get(route('withdrawl-transactions.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.withdrawl_transactions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_withdrawl_transaction()
    {
        $data = WithdrawlTransaction::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('withdrawl-transactions.store'), $data);

        $this->assertDatabaseHas('withdrawl_transactions', $data);

        $withdrawlTransaction = WithdrawlTransaction::latest('id')->first();

        $response->assertRedirect(
            route('withdrawl-transactions.edit', $withdrawlTransaction)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_withdrawl_transaction()
    {
        $withdrawlTransaction = WithdrawlTransaction::factory()->create();

        $response = $this->get(
            route('withdrawl-transactions.show', $withdrawlTransaction)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.withdrawl_transactions.show')
            ->assertViewHas('withdrawlTransaction');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_withdrawl_transaction()
    {
        $withdrawlTransaction = WithdrawlTransaction::factory()->create();

        $response = $this->get(
            route('withdrawl-transactions.edit', $withdrawlTransaction)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.withdrawl_transactions.edit')
            ->assertViewHas('withdrawlTransaction');
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

        $response = $this->put(
            route('withdrawl-transactions.update', $withdrawlTransaction),
            $data
        );

        $data['id'] = $withdrawlTransaction->id;

        $this->assertDatabaseHas('withdrawl_transactions', $data);

        $response->assertRedirect(
            route('withdrawl-transactions.edit', $withdrawlTransaction)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_withdrawl_transaction()
    {
        $withdrawlTransaction = WithdrawlTransaction::factory()->create();

        $response = $this->delete(
            route('withdrawl-transactions.destroy', $withdrawlTransaction)
        );

        $response->assertRedirect(route('withdrawl-transactions.index'));

        $this->assertModelMissing($withdrawlTransaction);
    }
}
