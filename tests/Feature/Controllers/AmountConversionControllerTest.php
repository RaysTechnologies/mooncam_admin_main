<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\AmountConversion;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AmountConversionControllerTest extends TestCase
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
    public function it_displays_index_view_with_amount_conversions()
    {
        $amountConversions = AmountConversion::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('amount-conversions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.amount_conversions.index')
            ->assertViewHas('amountConversions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_amount_conversion()
    {
        $response = $this->get(route('amount-conversions.create'));

        $response->assertOk()->assertViewIs('app.amount_conversions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_amount_conversion()
    {
        $data = AmountConversion::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('amount-conversions.store'), $data);

        $this->assertDatabaseHas('amount_conversions', $data);

        $amountConversion = AmountConversion::latest('id')->first();

        $response->assertRedirect(
            route('amount-conversions.edit', $amountConversion)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_amount_conversion()
    {
        $amountConversion = AmountConversion::factory()->create();

        $response = $this->get(
            route('amount-conversions.show', $amountConversion)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.amount_conversions.show')
            ->assertViewHas('amountConversion');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_amount_conversion()
    {
        $amountConversion = AmountConversion::factory()->create();

        $response = $this->get(
            route('amount-conversions.edit', $amountConversion)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.amount_conversions.edit')
            ->assertViewHas('amountConversion');
    }

    /**
     * @test
     */
    public function it_updates_the_amount_conversion()
    {
        $amountConversion = AmountConversion::factory()->create();

        $user = User::factory()->create();

        $data = [
            'token' => $this->faker->text(255),
            'amount' => $this->faker->text(255),
            'unit' => $this->faker->text(255),
            'symbol' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->put(
            route('amount-conversions.update', $amountConversion),
            $data
        );

        $data['id'] = $amountConversion->id;

        $this->assertDatabaseHas('amount_conversions', $data);

        $response->assertRedirect(
            route('amount-conversions.edit', $amountConversion)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_amount_conversion()
    {
        $amountConversion = AmountConversion::factory()->create();

        $response = $this->delete(
            route('amount-conversions.destroy', $amountConversion)
        );

        $response->assertRedirect(route('amount-conversions.index'));

        $this->assertModelMissing($amountConversion);
    }
}
