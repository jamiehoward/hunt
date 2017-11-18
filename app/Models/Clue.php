<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clue extends Model
{
    public function campaign()
    {
        return $this->hasOne(Campaign::class);
    }
}
