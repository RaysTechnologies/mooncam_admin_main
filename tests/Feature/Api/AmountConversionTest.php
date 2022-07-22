<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AmountConversion;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AmountConversionTest extends TestCase
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
    public function it_gets_amount_conversions_list()
    {
        $amountConversions = AmountConversion::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.amount-conversions.index'));

        $response->assertOk()->assertSee($amountConversions[0]->token);
    }

    /**
     * @test
     */
    public function it_stores_the_amount_conversion()
    {
        $data = AmountConversion::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.amount-conversions.store'),
            $data
        );

        $this->assertDatabaseHas('amount_conversions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.amount-conversions.update', $amountConversion),
            $data
        );

        $data['id'] = $amountConversion->id;

        $this->assertDatabaseHas('amount_conversions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_amount_conversion()
    {
        $amountConversion = AmountConversion::factory()->create();

        $response = $this->deleteJson(
            route('api.amount-conversions.destroy', $amountConversion)
        );

        $this->assertModelMissing($amountConversion);

        $response->assertNoContent();
    }
}
