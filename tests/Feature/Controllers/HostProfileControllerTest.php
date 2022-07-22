<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\HostProfile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HostProfileControllerTest extends TestCase
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
    public function it_displays_index_view_with_host_profiles()
    {
        $hostProfiles = HostProfile::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('host-profiles.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.host_profiles.index')
            ->assertViewHas('hostProfiles');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_host_profile()
    {
        $response = $this->get(route('host-profiles.create'));

        $response->assertOk()->assertViewIs('app.host_profiles.create');
    }

    /**
     * @test
     */
    public function it_stores_the_host_profile()
    {
        $data = HostProfile::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('host-profiles.store'), $data);

        $this->assertDatabaseHas('host_profiles', $data);

        $hostProfile = HostProfile::latest('id')->first();

        $response->assertRedirect(route('host-profiles.edit', $hostProfile));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_host_profile()
    {
        $hostProfile = HostProfile::factory()->create();

        $response = $this->get(route('host-profiles.show', $hostProfile));

        $response
            ->assertOk()
            ->assertViewIs('app.host_profiles.show')
            ->assertViewHas('hostProfile');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_host_profile()
    {
        $hostProfile = HostProfile::factory()->create();

        $response = $this->get(route('host-profiles.edit', $hostProfile));

        $response
            ->assertOk()
            ->assertViewIs('app.host_profiles.edit')
            ->assertViewHas('hostProfile');
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

        $response = $this->put(
            route('host-profiles.update', $hostProfile),
            $data
        );

        $data['id'] = $hostProfile->id;

        $this->assertDatabaseHas('host_profiles', $data);

        $response->assertRedirect(route('host-profiles.edit', $hostProfile));
    }

    /**
     * @test
     */
    public function it_deletes_the_host_profile()
    {
        $hostProfile = HostProfile::factory()->create();

        $response = $this->delete(route('host-profiles.destroy', $hostProfile));

        $response->assertRedirect(route('host-profiles.index'));

        $this->assertModelMissing($hostProfile);
    }
}
