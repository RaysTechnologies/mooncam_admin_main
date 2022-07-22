<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BankDetails;

use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankDetailsTest extends TestCase
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
    public function it_gets_all_bank_details_list()
    {
        $allBankDetails = BankDetails::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-bank-details.index'));

        $response->assertOk()->assertSee($allBankDetails[0]->country);
    }

    /**
     * @test
     */
    public function it_stores_the_bank_details()
    {
        $data = BankDetails::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-bank-details.store'), $data);

        $this->assertDatabaseHas('bank_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.all-bank-details.update', $bankDetails),
            $data
        );

        $data['id'] = $bankDetails->id;

        $this->assertDatabaseHas('bank_details', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bank_details()
    {
        $bankDetails = BankDetails::factory()->create();

        $response = $this->deleteJson(
            route('api.all-bank-details.destroy', $bankDetails)
        );

        $this->assertModelMissing($bankDetails);

        $response->assertNoContent();
    }
}
