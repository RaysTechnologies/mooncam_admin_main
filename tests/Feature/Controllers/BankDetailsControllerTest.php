<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BankDetails;

use App\Models\HostProfile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankDetailsControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_bank_details()
    {
        $allBankDetails = BankDetails::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-bank-details.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_bank_details.index')
            ->assertViewHas('allBankDetails');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bank_details()
    {
        $response = $this->get(route('all-bank-details.create'));

        $response->assertOk()->assertViewIs('app.all_bank_details.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bank_details()
    {
        $data = BankDetails::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-bank-details.store'), $data);

        $this->assertDatabaseHas('bank_details', $data);

        $bankDetails = BankDetails::latest('id')->first();

        $response->assertRedirect(route('all-bank-details.edit', $bankDetails));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bank_details()
    {
        $bankDetails = BankDetails::factory()->create();

        $response = $this->get(route('all-bank-details.show', $bankDetails));

        $response
            ->assertOk()
            ->assertViewIs('app.all_bank_details.show')
            ->assertViewHas('bankDetails');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bank_details()
    {
        $bankDetails = BankDetails::factory()->create();

        $response = $this->get(route('all-bank-details.edit', $bankDetails));

        $response
            ->assertOk()
            ->assertViewIs('app.all_bank_details.edit')
            ->assertViewHas('bankDetails');
    }

    /**
     * @test
     */
    public function it_updates_the_bank_details()
    {
        $bankDetails = BankDetails::factory()->create();

        $hostProfile = HostProfile::factory()->create();

        $data = [
            'country' => $this->faker->country,
            'host_profile_id' => $hostProfile->id,
        ];

        $response = $this->put(
            route('all-bank-details.update', $bankDetails),
            $data
        );

        $data['id'] = $bankDetails->id;

        $this->assertDatabaseHas('bank_details', $data);

        $response->assertRedirect(route('all-bank-details.edit', $bankDetails));
    }

    /**
     * @test
     */
    public function it_deletes_the_bank_details()
    {
        $bankDetails = BankDetails::factory()->create();

        $response = $this->delete(
            route('all-bank-details.destroy', $bankDetails)
        );

        $response->assertRedirect(route('all-bank-details.index'));

        $this->assertModelMissing($bankDetails);
    }
}
