<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ReportAndBlock;

use App\Models\HostProfile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportAndBlockControllerTest extends TestCase
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
    public function it_displays_index_view_with_report_and_blocks()
    {
        $reportAndBlocks = ReportAndBlock::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('report-and-blocks.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.report_and_blocks.index')
            ->assertViewHas('reportAndBlocks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_report_and_block()
    {
        $response = $this->get(route('report-and-blocks.create'));

        $response->assertOk()->assertViewIs('app.report_and_blocks.create');
    }

    /**
     * @test
     */
    public function it_stores_the_report_and_block()
    {
        $data = ReportAndBlock::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('report-and-blocks.store'), $data);

        $this->assertDatabaseHas('report_and_blocks', $data);

        $reportAndBlock = ReportAndBlock::latest('id')->first();

        $response->assertRedirect(
            route('report-and-blocks.edit', $reportAndBlock)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_report_and_block()
    {
        $reportAndBlock = ReportAndBlock::factory()->create();

        $response = $this->get(
            route('report-and-blocks.show', $reportAndBlock)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.report_and_blocks.show')
            ->assertViewHas('reportAndBlock');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_report_and_block()
    {
        $reportAndBlock = ReportAndBlock::factory()->create();

        $response = $this->get(
            route('report-and-blocks.edit', $reportAndBlock)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.report_and_blocks.edit')
            ->assertViewHas('reportAndBlock');
    }

    /**
     * @test
     */
    public function it_updates_the_report_and_block()
    {
        $reportAndBlock = ReportAndBlock::factory()->create();

        $hostProfile = HostProfile::factory()->create();

        $data = [
            'blocked_user_id' => $this->faker->text(255),
            'blocked_user_name' => $this->faker->text(255),
            'host_profile_id' => $hostProfile->id,
        ];

        $response = $this->put(
            route('report-and-blocks.update', $reportAndBlock),
            $data
        );

        $data['id'] = $reportAndBlock->id;

        $this->assertDatabaseHas('report_and_blocks', $data);

        $response->assertRedirect(
            route('report-and-blocks.edit', $reportAndBlock)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_report_and_block()
    {
        $reportAndBlock = ReportAndBlock::factory()->create();

        $response = $this->delete(
            route('report-and-blocks.destroy', $reportAndBlock)
        );

        $response->assertRedirect(route('report-and-blocks.index'));

        $this->assertModelMissing($reportAndBlock);
    }
}
