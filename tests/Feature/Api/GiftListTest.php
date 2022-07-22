<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\GiftList;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GiftListTest extends TestCase
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
    public function it_gets_gift_lists_list()
    {
        $giftLists = GiftList::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.gift-lists.index'));

        $response->assertOk()->assertSee($giftLists[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_gift_list()
    {
        $data = GiftList::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.gift-lists.store'), $data);

        $this->assertDatabaseHas('gift_lists', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.gift-lists.update', $giftList),
            $data
        );

        $data['id'] = $giftList->id;

        $this->assertDatabaseHas('gift_lists', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_gift_list()
    {
        $giftList = GiftList::factory()->create();

        $response = $this->deleteJson(
            route('api.gift-lists.destroy', $giftList)
        );

        $this->assertModelMissing($giftList);

        $response->assertNoContent();
    }
}
