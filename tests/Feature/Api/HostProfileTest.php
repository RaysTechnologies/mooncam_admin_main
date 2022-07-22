<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HostProfileTest extends TestCase
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
    public function it_gets_host_profiles_list()
    {
        $hostProfiles = HostProfile::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.host-profiles.index'));

        $response->assertOk()->assertSee($hostProfiles[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_host_profile()
    {
        $data = HostProfile::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.host-profiles.store'), $data);

        $this->assertDatabaseHas('host_profiles', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_host_profile()
    {
        $hostProfile = HostProfile::factory()->create();

        $user = User::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'age' => $this->faker->text(255),
            'mobile' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'gender' => $this->faker->text(255),
            'fans_count' => $this->faker->text(255),
            'followup_count' => $this->faker->text(255),
            'visitor_count' => $this->faker->text(255),
            'firebase_id' => $this->faker->text(255),
            'token_rate_videocall' => $this->faker->text(255),
            'token_rate_groupcall' => $this->faker->text(255),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.host-profiles.update', $hostProfile),
            $data
        );

        $data['id'] = $hostProfile->id;

        $this->assertDatabaseHas('host_profiles', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_host_profile()
    {
        $hostProfile = HostProfile::factory()->create();

        $response = $this->deleteJson(
            route('api.host-profiles.destroy', $hostProfile)
        );

        $this->assertModelMissing($hostProfile);

        $response->assertNoContent();
    }
}
