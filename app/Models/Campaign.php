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
