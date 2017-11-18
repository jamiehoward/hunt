<?php

use App\Models\Clue;
use App\Models\Campaign;
use Illuminate\Database\Seeder;

class CluesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('clues')->truncate();

        foreach (Campaign::get() as $campaign) {
            factory(Clue::class, 4)->create([
                'campaign_id' => $campaign->id
                ]);
        }
    }
}
