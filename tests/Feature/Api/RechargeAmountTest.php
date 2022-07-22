<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\RechargeAmount;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RechargeAmountTest extends TestCase
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
    public function it_gets_recharge_amounts_list()
    {
        $rechargeAmounts = RechargeAmount::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.recharge-amounts.index'));

        $response->assertOk()->assertSee($rechargeAmounts[0]->amount);
    }

    /**
     * @test
     */
    public function it_stores_the_recharge_amount()
    {
        $data = RechargeAmount::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.recharge-amounts.store'), $data);

        $this->assertDatabaseHas('recharge_amounts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_recharge_amount()
    {
        $rechargeAmount = RechargeAmount::factory()->create();

        $user = User::factory()->create();

        $data = [
            'amount' => $this->faker->text(255),
            'token' => $this->faker->text(255),
            'unit' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.recharge-amounts.update', $rechargeAmount),
            $data
        );

        $data['id'] = $rechargeAmount->id;

        $this->assertDatabaseHas('recharge_amounts', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_recharge_amount()
    {
        $rechargeAmount = RechargeAmount::factory()->create();

        $response = $this->deleteJson(
            route('api.recharge-amounts.destroy', $rechargeAmount)
        );

        $this->assertModelMissing($rechargeAmount);

        $response->assertNoContent();
    }
}
