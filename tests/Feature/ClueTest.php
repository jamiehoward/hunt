<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Clue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClueTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(\App\Models\User::class)->create();
        $this->campaign = factory(\App\Models\Campaign::class)->create();
    }

    public function testCluesCanBeRetrievedByCampaign()
    {
        $clues = factory(Clue::class, 5)->create(['campaign_id' => $this->campaign->id]);

        $response = $this->actingAs($this->user, 'api')
            ->json('GET', '/api/campaigns/' . $this->campaign->id . '/clues');

        $response->assertStatus(200);
        $this->assertCount(5, json_decode($response->getContent()));
    }

    public function testClueCanBeAddedToCampaign()
    {
        $clue = factory(Clue::class)->make();

        $response = $this->actingAs($this->user, 'api')
            ->json('POST', '/api/campaigns/' . $this->campaign->id . '/clues', [
                'label' => $clue->label,
                'answer' => $clue->answer,
                ]);

        $response->assertStatus(200);
    }

    public function testClueCanBeUpdated()
    {
        $clue = factory(Clue::class)->create(['campaign_id' => $this->campaign->id]);

        $response = $this->actingAs($this->user, 'api')
            ->json('PUT', '/api/clues/' . $clue->id, [
                'label' => 'New label',
                ]);

        $response->assertStatus(200);

        $this->assertEquals('New label', Clue::find($clue->id)->label);
    }
}
