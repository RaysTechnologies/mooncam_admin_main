<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\RechargeAmount;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RechargeAmountControllerTest extends TestCase
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
    public function it_displays_index_view_with_recharge_amounts()
    {
        $rechargeAmounts = RechargeAmount::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('recharge-amounts.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.recharge_amounts.index')
            ->assertViewHas('rechargeAmounts');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_recharge_amount()
    {
        $response = $this->get(route('recharge-amounts.create'));

        $response->assertOk()->assertViewIs('app.recharge_amounts.create');
    }

    /**
     * @test
     */
    public function it_stores_the_recharge_amount()
    {
        $data = RechargeAmount::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('recharge-amounts.store'), $data);

        $this->assertDatabaseHas('recharge_amounts', $data);

        $rechargeAmount = RechargeAmount::latest('id')->first();

        $response->assertRedirect(
            route('recharge-amounts.edit', $rechargeAmount)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_recharge_amount()
    {
        $rechargeAmount = RechargeAmount::factory()->create();

        $response = $this->get(route('recharge-amounts.show', $rechargeAmount));

        $response
            ->assertOk()
            ->assertViewIs('app.recharge_amounts.show')
            ->assertViewHas('rechargeAmount');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_recharge_amount()
    {
        $rechargeAmount = RechargeAmount::factory()->create();

        $response = $this->get(route('recharge-amounts.edit', $rechargeAmount));

        $response
            ->assertOk()
            ->assertViewIs('app.recharge_amounts.edit')
            ->assertViewHas('rechargeAmount');
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

        $response = $this->put(
            route('recharge-amounts.update', $rechargeAmount),
            $data
        );

        $data['id'] = $rechargeAmount->id;

        $this->assertDatabaseHas('recharge_amounts', $data);

        $response->assertRedirect(
            route('recharge-amounts.edit', $rechargeAmount)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_recharge_amount()
    {
        $rechargeAmount = RechargeAmount::factory()->create();

        $response = $this->delete(
            route('recharge-amounts.destroy', $rechargeAmount)
        );

        $response->assertRedirect(route('recharge-amounts.index'));

        $this->assertModelMissing($rechargeAmount);
    }
}
