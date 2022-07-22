<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Gallery;
use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HostProfileGalleriesTest extends TestCase
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
    public function it_gets_host_profile_galleries()
    {
        $hostProfile = HostProfile::factory()->create();
        $galleries = Gallery::factory()
            ->count(2)
            ->create([
                'host_profile_id' => $hostProfile->id,
            ]);

        $response = $this->getJson(
            route('api.host-profiles.galleries.index', $hostProfile)
        );

        $response->assertOk()->assertSee($galleries[0]->photo);
    }

    /**
     * @test
     */
    public function it_stores_the_host_profile_galleries()
    {
        $hostProfile = HostProfile::factory()->create();
        $data = Gallery::factory()
            ->make([
                'host_profile_id' => $hostProfile->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.host-profiles.galleries.store', $hostProfile),
            $data
        );

        $this->assertDatabaseHas('galleries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $gallery = Gallery::latest('id')->first();

        $this->assertEquals($hostProfile->id, $gallery->host_profile_id);
    }
}
