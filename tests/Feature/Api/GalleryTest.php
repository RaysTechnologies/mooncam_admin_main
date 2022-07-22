<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Gallery;

use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GalleryTest extends TestCase
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
    public function it_gets_galleries_list()
    {
        $galleries = Gallery::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.galleries.index'));

        $response->assertOk()->assertSee($galleries[0]->photo);
    }

    /**
     * @test
     */
    public function it_stores_the_gallery()
    {
        $data = Gallery::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.galleries.store'), $data);

        $this->assertDatabaseHas('galleries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_gallery()
    {
        $gallery = Gallery::factory()->create();

        $hostProfile = HostProfile::factory()->create();

        $data = [
            'host_profile_id' => $hostProfile->id,
        ];

        $response = $this->putJson(
            route('api.galleries.update', $gallery),
            $data
        );

        $data['id'] = $gallery->id;

        $this->assertDatabaseHas('galleries', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_gallery()
    {
        $gallery = Gallery::factory()->create();

        $response = $this->deleteJson(route('api.galleries.destroy', $gallery));

        $this->assertModelMissing($gallery);

        $response->assertNoContent();
    }
}
