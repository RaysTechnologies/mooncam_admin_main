<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Gallery;

use App\Models\HostProfile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GalleryControllerTest extends TestCase
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
    public function it_displays_index_view_with_galleries()
    {
        $galleries = Gallery::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('galleries.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.galleries.index')
            ->assertViewHas('galleries');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_gallery()
    {
        $response = $this->get(route('galleries.create'));

        $response->assertOk()->assertViewIs('app.galleries.create');
    }

    /**
     * @test
     */
    public function it_stores_the_gallery()
    {
        $data = Gallery::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('galleries.store'), $data);

        $this->assertDatabaseHas('galleries', $data);

        $gallery = Gallery::latest('id')->first();

        $response->assertRedirect(route('galleries.edit', $gallery));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_gallery()
    {
        $gallery = Gallery::factory()->create();

        $response = $this->get(route('galleries.show', $gallery));

        $response
            ->assertOk()
            ->assertViewIs('app.galleries.show')
            ->assertViewHas('gallery');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_gallery()
    {
        $gallery = Gallery::factory()->create();

        $response = $this->get(route('galleries.edit', $gallery));

        $response
            ->assertOk()
            ->assertViewIs('app.galleries.edit')
            ->assertViewHas('gallery');
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

        $response = $this->put(route('galleries.update', $gallery), $data);

        $data['id'] = $gallery->id;

        $this->assertDatabaseHas('galleries', $data);

        $response->assertRedirect(route('galleries.edit', $gallery));
    }

    /**
     * @test
     */
    public function it_deletes_the_gallery()
    {
        $gallery = Gallery::factory()->create();

        $response = $this->delete(route('galleries.destroy', $gallery));

        $response->assertRedirect(route('galleries.index'));

        $this->assertModelMissing($gallery);
    }
}
