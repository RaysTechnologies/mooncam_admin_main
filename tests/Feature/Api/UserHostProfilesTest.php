<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserHostProfilesTest extends TestCase
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
    public function it_gets_user_host_profiles()
    {
        $user = User::factory()->create();
        $hostProfiles = HostProfile::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.host-profiles.index', $user)
        );

        $response->assertOk()->assertSee($hostProfiles[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_user_host_profiles()
    {
        $user = User::factory()->create();
        $data = HostProfile::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.host-profiles.store', $user),
            $data
        );

        $this->assertDatabaseHas('host_profiles', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $hostProfile = HostProfile::latest('id')->first();

        $this->assertEquals($user->id, $hostProfile->user_id);
    }
}
