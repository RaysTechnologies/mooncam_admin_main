<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CountryList;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryListControllerTest extends TestCase
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
    public function it_displays_index_view_with_country_lists()
    {
        $countryLists = CountryList::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('country-lists.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.country_lists.index')
            ->assertViewHas('countryLists');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_country_list()
    {
        $response = $this->get(route('country-lists.create'));

        $response->assertOk()->assertViewIs('app.country_lists.create');
    }

    /**
     * @test
     */
    public function it_stores_the_country_list()
    {
        $data = CountryList::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('country-lists.store'), $data);

        $this->assertDatabaseHas('country_lists', $data);

        $countryList = CountryList::latest('id')->first();

        $response->assertRedirect(route('country-lists.edit', $countryList));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_country_list()
    {
        $countryList = CountryList::factory()->create();

        $response = $this->get(route('country-lists.show', $countryList));

        $response
            ->assertOk()
            ->assertViewIs('app.country_lists.show')
            ->assertViewHas('countryList');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_country_list()
    {
        $countryList = CountryList::factory()->create();

        $response = $this->get(route('country-lists.edit', $countryList));

        $response
            ->assertOk()
            ->assertViewIs('app.country_lists.edit')
            ->assertViewHas('countryList');
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

        $response = $this->put(
            route('country-lists.update', $countryList),
            $data
        );

        $data['id'] = $countryList->id;

        $this->assertDatabaseHas('country_lists', $data);

        $response->assertRedirect(route('country-lists.edit', $countryList));
    }

    /**
     * @test
     */
    public function it_deletes_the_country_list()
    {
        $countryList = CountryList::factory()->create();

        $response = $this->delete(route('country-lists.destroy', $countryList));

        $response->assertRedirect(route('country-lists.index'));

        $this->assertModelMissing($countryList);
    }
}
