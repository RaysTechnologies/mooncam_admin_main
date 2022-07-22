<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ReportAndBlock;

use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportAndBlockTest extends TestCase
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
    public function it_gets_report_and_blocks_list()
    {
        $reportAndBlocks = ReportAndBlock::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.report-and-blocks.index'));

        $response->assertOk()->assertSee($reportAndBlocks[0]->blocked_user_id);
    }

    /**
     * @test
     */
    public function it_stores_the_report_and_block()
    {
        $data = ReportAndBlock::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.report-and-blocks.store'),
            $data
        );

        $this->assertDatabaseHas('report_and_blocks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.report-and-blocks.update', $reportAndBlock),
            $data
        );

        $data['id'] = $reportAndBlock->id;

        $this->assertDatabaseHas('report_and_blocks', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_report_and_block()
    {
        $reportAndBlock = ReportAndBlock::factory()->create();

        $response = $this->deleteJson(
            route('api.report-and-blocks.destroy', $reportAndBlock)
        );

        $this->assertModelMissing($reportAndBlock);

        $response->assertNoContent();
    }
}
