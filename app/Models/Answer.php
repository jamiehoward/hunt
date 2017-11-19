<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public $fillable = ['content', 'user_id', 'clue_id', 'correct'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function clue()
    {
        return $this->hasOne(Clue::class);
    }
}
