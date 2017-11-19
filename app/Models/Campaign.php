<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public $fillable = ['title', 'introduction'];

    public function clues()
    {
        return $this->hasMany(Clue::class);
    }

    public function players()
    {
        return $this->belongsToMany(User::class)->withPivot('code');
    }

    public function incompleteClues()
    {
        return $this->clues()->get()->reject(function($clue) {
            foreach(\Auth::user()->answers as $answer) {
                if ($answer->clue_id == $clue->id && $answer->correct == 1) {
                    return true;
                }
            }
        });
    }

    public static function findByCode(string $code)
    {
        foreach (Campaign::get() as $campaign) {
            if ($campaign->players()->count() > 0) {
                foreach ($campaign->players as $player) {
                    if ($code == $player->pivot->code) {
                        return $campaign;
                    }
                }
            }
        }
    }
}
