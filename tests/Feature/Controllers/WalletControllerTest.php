<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Wallet;

use App\Models\HostProfile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WalletControllerTest extends TestCase
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
    public function it_displays_index_view_with_wallets()
    {
        $wallets = Wallet::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wallets.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wallets.index')
            ->assertViewHas('wallets');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wallet()
    {
        $response = $this->get(route('wallets.create'));

        $response->assertOk()->assertViewIs('app.wallets.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wallet()
    {
        $data = Wallet::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wallets.store'), $data);

        $this->assertDatabaseHas('wallets', $data);

        $wallet = Wallet::latest('id')->first();

        $response->assertRedirect(route('wallets.edit', $wallet));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wallet()
    {
        $wallet = Wallet::factory()->create();

        $response = $this->get(route('wallets.show', $wallet));

        $response
            ->assertOk()
            ->assertViewIs('app.wallets.show')
            ->assertViewHas('wallet');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wallet()
    {
        $wallet = Wallet::factory()->create();

        $response = $this->get(route('wallets.edit', $wallet));

        $response
            ->assertOk()
            ->assertViewIs('app.wallets.edit')
            ->assertViewHas('wallet');
    }

    /**
     * @test
     */
    public function it_updates_the_wallet()
    {
        $wallet = Wallet::factory()->create();

        $hostProfile = HostProfile::factory()->create();

        $data = [
            'token' => $this->faker->text(255),
            'free_token' => $this->faker->text(255),
            'host_profile_id' => $hostProfile->id,
        ];

        $response = $this->put(route('wallets.update', $wallet), $data);

        $data['id'] = $wallet->id;

        $this->assertDatabaseHas('wallets', $data);

        $response->assertRedirect(route('wallets.edit', $wallet));
    }

    /**
     * @test
     */
    public function it_deletes_the_wallet()
    {
        $wallet = Wallet::factory()->create();

        $response = $this->delete(route('wallets.destroy', $wallet));

        $response->assertRedirect(route('wallets.index'));

        $this->assertModelMissing($wallet);
    }
}
