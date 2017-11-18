<?php

namespace App\Http\Controllers;

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

        return redirect("/play/{$campaign->id}");
    }

    public function show(int $id)
    {
        $data = [
            'campaign' => Campaign::findOrFail($id)
        ];

        return view('play.intro', $data);
    }
}
