<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CallPrice;

use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CallPriceTest extends TestCase
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
    public function it_gets_call_prices_list()
    {
        $callPrices = CallPrice::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.call-prices.index'));

        $response->assertOk()->assertSee($callPrices[0]->video_call);
    }

    /**
     * @test
     */
    public function it_stores_the_call_price()
    {
        $data = CallPrice::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.call-prices.store'), $data);

        $this->assertDatabaseHas('call_prices', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_call_price()
    {
        $callPrice = CallPrice::factory()->create();

        $hostProfile = HostProfile::factory()->create();

        $data = [
            'video_call' => $this->faker->text(255),
            'live_streaming' => $this->faker->text(255),
            'video_call_price_limit' => $this->faker->text(255),
            'live_streaming_call_price_limit' => $this->faker->text(255),
            'photo_price' => $this->faker->text(255),
            'host_profile_id' => $hostProfile->id,
        ];

        $response = $this->putJson(
            route('api.call-prices.update', $callPrice),
            $data
        );

        $data['id'] = $callPrice->id;

        $this->assertDatabaseHas('call_prices', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_call_price()
    {
        $callPrice = CallPrice::factory()->create();

        $response = $this->deleteJson(
            route('api.call-prices.destroy', $callPrice)
        );

        $this->assertModelMissing($callPrice);

        $response->assertNoContent();
    }
}
