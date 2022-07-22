<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CountryList;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryListTest extends TestCase
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
    public function it_gets_country_lists_list()
    {
        $countryLists = CountryList::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.country-lists.index'));

        $response->assertOk()->assertSee($countryLists[0]->country);
    }

    /**
     * @test
     */
    public function it_stores_the_country_list()
    {
        $data = CountryList::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.country-lists.store'), $data);

        $this->assertDatabaseHas('country_lists', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_country_list()
    {
        $countryList = CountryList::factory()->create();

        $user = User::factory()->create();

        $data = [
            'country' => $this->faker->country,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.country-lists.update', $countryList),
            $data
        );

        $data['id'] = $countryList->id;

        $this->assertDatabaseHas('country_lists', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_country_list()
    {
        $countryList = CountryList::factory()->create();

        $response = $this->deleteJson(
            route('api.country-lists.destroy', $countryList)
        );

        $this->assertModelMissing($countryList);

        $response->assertNoContent();
    }
}
