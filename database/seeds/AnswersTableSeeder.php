<?php

use App\Models\Answer;
use App\Models\Campaign;
use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('answers')->truncate();

        foreach (Campaign::get() as $campaign) {
            foreach ($campaign->clues as $clue) {
                foreach ($campaign->players as $player) {
                    factory(Answer::class, rand(0,4))->create([
                        'clue_id' => $clue->id,
                        'user_id' => $player->id
                        ]);
                }
            }
        }
    }
}
