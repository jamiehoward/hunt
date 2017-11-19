<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clue extends Model
{
    public $fillable = ['label', 'answer'];
    
    public function campaign()
    {
        return $this->hasOne(Campaign::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
