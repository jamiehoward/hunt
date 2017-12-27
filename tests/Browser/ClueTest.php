<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClueTest extends DuskTestCase
{
    use DatabaseMigrations;

    private $user;
    private $campaign;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(\App\Models\User::class)->create();
        $this->campaign = factory(\App\Models\Campaign::class)->create(['user_id' => $this->user->id]);
        factory(\App\Models\Clue::class, 5)->create(['campaign_id' => $this->campaign->id]);
    }

    public function testCluesCanBeListed()
    {
        $user = $this->user;
        $campaign = $this->campaign;

        $this->browse(function (Browser $browser) use ($user, $campaign) {
            $browser->loginAs($user)
                    ->visit('/campaigns' . "/{$campaign->id}")
                    ->assertSee($campaign->title)
                    ->assertDontSee('No clues yet');
        });
    }

    public function testClueCanBeAdded()
    {
        $user = $this->user;
        $campaign = $this->campaign;

        $this->browse(function (Browser $browser) use ($user, $campaign) {
            $browser->loginAs($user)
                    ->visit('/campaigns' . "/{$campaign->id}")
                    ->type('#clue-label', 'Test Clue')
                    ->type('#clue-answer', 'Test Answer')
                    ->press('#clue-submit')
                    ->assertSee('Test Clue');
        });

        $this->assertCount(6, $this->campaign->clues);
    }
}
