<?php

namespace App\Http\Controllers;

use App\Models\Clue;
use App\Models\Campaign;
use App\Models\CampaignUser;
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
        $code = CampaignUser::where('code', $code)->firstOrFail();

        if (! $code->campaign) {
            return $this->showInvalidCampaignError();
        }
        
        $clues = $code->campaign->incompleteClues();

        if (is_null($code->started_at)) {
            return $this->showIntro($code);
        } elseif ($clues->count() == 0) {
            return view('play.resolution', compact('code'));
        }

        return $this->showClue($code);
    }

    protected function showInvalidCampaignError() {
        return view('play.invalid');
    }

    protected function showIntro(CampaignUser $code)
    {
        $code->begin();

        $data = [
            'campaign' => $code->campaign
        ];

        return view('play.intro', $data);
    }

    protected function showClue(CampaignUser $code)
    {
        $data = [
            'clue' => $code->nextClue(),
            'percentage' => $code->completionPercentage
        ];

        // dd($data);

        return view('play.step', $data);
    }
}
