<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\HostProfile;
use App\Models\VideoCallTransaction;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HostProfileVideoCallTransactionsTest extends TestCase
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
    public function it_gets_host_profile_video_call_transactions()
    {
        $hostProfile = HostProfile::factory()->create();
        $videoCallTransactions = VideoCallTransaction::factory()
            ->count(2)
            ->create([
                'host_profile_id' => $hostProfile->id,
            ]);

        $response = $this->getJson(
            route(
                'api.host-profiles.video-call-transactions.index',
                $hostProfile
            )
        );

        $response
            ->assertOk()
            ->assertSee($videoCallTransactions[0]->reciever_id);
    }

    /**
     * @test
     */
    public function it_stores_the_host_profile_video_call_transactions()
    {
        $hostProfile = HostProfile::factory()->create();
        $data = VideoCallTransaction::factory()
            ->make([
                'host_profile_id' => $hostProfile->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.host-profiles.video-call-transactions.store',
                $hostProfile
            ),
            $data
        );

        $this->assertDatabaseHas('video_call_transactions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $videoCallTransaction = VideoCallTransaction::latest('id')->first();

        $this->assertEquals(
            $hostProfile->id,
            $videoCallTransaction->host_profile_id
        );
    }
}
