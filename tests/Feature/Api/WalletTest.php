<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Wallet;

use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WalletTest extends TestCase
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
    public function it_gets_wallets_list()
    {
        $wallets = Wallet::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wallets.index'));

        $response->assertOk()->assertSee($wallets[0]->token);
    }

    /**
     * @test
     */
    public function it_stores_the_wallet()
    {
        $data = Wallet::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wallets.store'), $data);

        $this->assertDatabaseHas('wallets', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.wallets.update', $wallet), $data);

        $data['id'] = $wallet->id;

        $this->assertDatabaseHas('wallets', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wallet()
    {
        $wallet = Wallet::factory()->create();

        $response = $this->deleteJson(route('api.wallets.destroy', $wallet));

        $this->assertModelMissing($wallet);

        $response->assertNoContent();
    }
}
