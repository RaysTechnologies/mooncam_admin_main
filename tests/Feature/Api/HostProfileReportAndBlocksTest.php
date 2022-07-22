<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\HostProfile;
use App\Models\ReportAndBlock;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HostProfileReportAndBlocksTest extends TestCase
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
    public function it_gets_host_profile_report_and_blocks()
    {
        $hostProfile = HostProfile::factory()->create();
        $reportAndBlocks = ReportAndBlock::factory()
            ->count(2)
            ->create([
                'host_profile_id' => $hostProfile->id,
            ]);

        $response = $this->getJson(
            route('api.host-profiles.report-and-blocks.index', $hostProfile)
        );

        $response->assertOk()->assertSee($reportAndBlocks[0]->blocked_user_id);
    }

    /**
     * @test
     */
    public function it_stores_the_host_profile_report_and_blocks()
    {
        $hostProfile = HostProfile::factory()->create();
        $data = ReportAndBlock::factory()
            ->make([
                'host_profile_id' => $hostProfile->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.host-profiles.report-and-blocks.store', $hostProfile),
            $data
        );

        $this->assertDatabaseHas('report_and_blocks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $reportAndBlock = ReportAndBlock::latest('id')->first();

        $this->assertEquals($hostProfile->id, $reportAndBlock->host_profile_id);
    }
}
