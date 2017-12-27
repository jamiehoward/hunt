<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CampaignTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(\App\Models\User::class)->create();
    }

    public function testCampaignCanBeCreated()
    {
        $campaign = factory(Campaign::class)->make();

        $response = $this->actingAs($this->user, 'api')
            ->json('POST', '/api/campaigns', [
                'title' => $campaign->title,
                'introduction' => $campaign->introduction,
                ]);

        $response->assertStatus(200);
    }

    public function testUserCampaignsCanBeListed()
    {
        factory(Campaign::class, 5)->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user, 'api')
            ->json('GET', '/api/campaigns');

        $response->assertStatus(200);

        $this->assertCount(5, json_decode($response->getContent()));
    }

    public function testCampaignCanBeDeleted()
    {
        factory(Campaign::class, 5)->create(['user_id' => $this->user->id]);

        $campaign = $this->user->campaigns->first();

        $response = $this->actingAs($this->user, 'api')
            ->json('DELETE', '/api/campaigns/' . $campaign->id);

        $response->assertStatus(200);

        $this->assertCount(4, json_decode($response->getContent()));
    }
}
