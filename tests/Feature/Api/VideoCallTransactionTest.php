<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\VideoCallTransaction;

use App\Models\HostProfile;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoCallTransactionTest extends TestCase
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
    public function it_gets_video_call_transactions_list()
    {
        $videoCallTransactions = VideoCallTransaction::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.video-call-transactions.index'));

        $response
            ->assertOk()
            ->assertSee($videoCallTransactions[0]->reciever_id);
    }

    /**
     * @test
     */
    public function it_stores_the_video_call_transaction()
    {
        $data = VideoCallTransaction::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.video-call-transactions.store'),
            $data
        );

        $this->assertDatabaseHas('video_call_transactions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_video_call_transaction()
    {
        $videoCallTransaction = VideoCallTransaction::factory()->create();

        $hostProfile = HostProfile::factory()->create();

        $data = [
            'reciever_id' => $this->faker->text(255),
            'sender_id' => $this->faker->text(255),
            'call_duration' => $this->faker->text(255),
            'token_charge' => $this->faker->text(255),
            'host_profile_id' => $hostProfile->id,
        ];

        $response = $this->putJson(
            route('api.video-call-transactions.update', $videoCallTransaction),
            $data
        );

        $data['id'] = $videoCallTransaction->id;

        $this->assertDatabaseHas('video_call_transactions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_video_call_transaction()
    {
        $videoCallTransaction = VideoCallTransaction::factory()->create();

        $response = $this->deleteJson(
            route('api.video-call-transactions.destroy', $videoCallTransaction)
        );

        $this->assertModelMissing($videoCallTransaction);

        $response->assertNoContent();
    }
}
