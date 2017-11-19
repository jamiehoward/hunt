<?php

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Database\Seeder;

class CampaignUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('campaign_user')->truncate();

        foreach (Campaign::get() as $campaign) {
            $players = factory(User::class, rand(1,10))->create();

            foreach ($players as $player) {
                $campaign->players()->attach($player->id, ['code' => strtoupper(str_random(7))]);
            }

        }

        $campaign = Campaign::find(1);
        $campaign->players()->attach(1, ['code' => 'TEST123']);
    }
}
