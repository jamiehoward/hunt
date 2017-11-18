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
}
