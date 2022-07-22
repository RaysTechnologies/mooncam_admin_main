<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\GiftList;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GiftListControllerTest extends TestCase
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
    public function it_displays_index_view_with_gift_lists()
    {
        $giftLists = GiftList::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('gift-lists.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.gift_lists.index')
            ->assertViewHas('giftLists');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_gift_list()
    {
        $response = $this->get(route('gift-lists.create'));

        $response->assertOk()->assertViewIs('app.gift_lists.create');
    }

    /**
     * @test
     */
    public function it_stores_the_gift_list()
    {
        $data = GiftList::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('gift-lists.store'), $data);

        $this->assertDatabaseHas('gift_lists', $data);

        $giftList = GiftList::latest('id')->first();

        $response->assertRedirect(route('gift-lists.edit', $giftList));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_gift_list()
    {
        $giftList = GiftList::factory()->create();

        $response = $this->get(route('gift-lists.show', $giftList));

        $response
            ->assertOk()
            ->assertViewIs('app.gift_lists.show')
            ->assertViewHas('giftList');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_gift_list()
    {
        $giftList = GiftList::factory()->create();

        $response = $this->get(route('gift-lists.edit', $giftList));

        $response
            ->assertOk()
            ->assertViewIs('app.gift_lists.edit')
            ->assertViewHas('giftList');
    }

    /**
     * @test
     */
    public function it_updates_the_gift_list()
    {
        $giftList = GiftList::factory()->create();

        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'token' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->put(route('gift-lists.update', $giftList), $data);

        $data['id'] = $giftList->id;

        $this->assertDatabaseHas('gift_lists', $data);

        $response->assertRedirect(route('gift-lists.edit', $giftList));
    }

    /**
     * @test
     */
    public function it_deletes_the_gift_list()
    {
        $giftList = GiftList::factory()->create();

        $response = $this->delete(route('gift-lists.destroy', $giftList));

        $response->assertRedirect(route('gift-lists.index'));

        $this->assertModelMissing($giftList);
    }
}
