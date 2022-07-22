<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\VideoCallTransaction;

use App\Models\HostProfile;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoCallTransactionControllerTest extends TestCase
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
    public function it_displays_index_view_with_video_call_transactions()
    {
        $videoCallTransactions = VideoCallTransaction::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('video-call-transactions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.video_call_transactions.index')
            ->assertViewHas('videoCallTransactions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_video_call_transaction()
    {
        $response = $this->get(route('video-call-transactions.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.video_call_transactions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_video_call_transaction()
    {
        $data = VideoCallTransaction::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('video-call-transactions.store'), $data);

        $this->assertDatabaseHas('video_call_transactions', $data);

        $videoCallTransaction = VideoCallTransaction::latest('id')->first();

        $response->assertRedirect(
            route('video-call-transactions.edit', $videoCallTransaction)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_video_call_transaction()
    {
        $videoCallTransaction = VideoCallTransaction::factory()->create();

        $response = $this->get(
            route('video-call-transactions.show', $videoCallTransaction)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.video_call_transactions.show')
            ->assertViewHas('videoCallTransaction');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_video_call_transaction()
    {
        $videoCallTransaction = VideoCallTransaction::factory()->create();

        $response = $this->get(
            route('video-call-transactions.edit', $videoCallTransaction)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.video_call_transactions.edit')
            ->assertViewHas('videoCallTransaction');
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

        $response = $this->put(
            route('video-call-transactions.update', $videoCallTransaction),
            $data
        );

        $data['id'] = $videoCallTransaction->id;

        $this->assertDatabaseHas('video_call_transactions', $data);

        $response->assertRedirect(
            route('video-call-transactions.edit', $videoCallTransaction)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_video_call_transaction()
    {
        $videoCallTransaction = VideoCallTransaction::factory()->create();

        $response = $this->delete(
            route('video-call-transactions.destroy', $videoCallTransaction)
        );

        $response->assertRedirect(route('video-call-transactions.index'));

        $this->assertModelMissing($videoCallTransaction);
    }
}
