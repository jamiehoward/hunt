<?php

namespace App\Http\Controllers;

use App\Models\Clue;
use App\Models\Campaign;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    public function index(string $code)
    {
        $campaign = Campaign::findByCode($code);

        foreach ($campaign->players as $player) {
            if ($player->pivot->code == $code) {
                \Auth::login($player);
            }
        }

        return redirect("/play/$code");
    }

    public function show(string $code)
    {
        $campaign = Campaign::findByCode($code);

        if (! $campaign) {
            dd('Invalid campaign code!');
        }
        
        return $this->showClue($campaign->clues()->first());
    }

    protected function showIntro(Campaign $campaign)
    {
        $data = [
            'campaign' => $campaign
        ];

        return view('play.intro', $data);
    }

    protected function showClue(Clue $clue)
    {
        $data = [
            'clue' => $clue
        ];

        return view('play.step', $data);
    }
}
