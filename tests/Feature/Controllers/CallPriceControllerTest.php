<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CallPrice;

use App\Models\HostProfile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CallPriceControllerTest extends TestCase
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
    public function it_displays_index_view_with_call_prices()
    {
        $callPrices = CallPrice::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('call-prices.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.call_prices.index')
            ->assertViewHas('callPrices');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_call_price()
    {
        $response = $this->get(route('call-prices.create'));

        $response->assertOk()->assertViewIs('app.call_prices.create');
    }

    /**
     * @test
     */
    public function it_stores_the_call_price()
    {
        $data = CallPrice::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('call-prices.store'), $data);

        $this->assertDatabaseHas('call_prices', $data);

        $callPrice = CallPrice::latest('id')->first();

        $response->assertRedirect(route('call-prices.edit', $callPrice));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_call_price()
    {
        $callPrice = CallPrice::factory()->create();

        $response = $this->get(route('call-prices.show', $callPrice));

        $response
            ->assertOk()
            ->assertViewIs('app.call_prices.show')
            ->assertViewHas('callPrice');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_call_price()
    {
        $callPrice = CallPrice::factory()->create();

        $response = $this->get(route('call-prices.edit', $callPrice));

        $response
            ->assertOk()
            ->assertViewIs('app.call_prices.edit')
            ->assertViewHas('callPrice');
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

        $response = $this->put(route('call-prices.update', $callPrice), $data);

        $data['id'] = $callPrice->id;

        $this->assertDatabaseHas('call_prices', $data);

        $response->assertRedirect(route('call-prices.edit', $callPrice));
    }

    /**
     * @test
     */
    public function it_deletes_the_call_price()
    {
        $callPrice = CallPrice::factory()->create();

        $response = $this->delete(route('call-prices.destroy', $callPrice));

        $response->assertRedirect(route('call-prices.index'));

        $this->assertModelMissing($callPrice);
    }
}
