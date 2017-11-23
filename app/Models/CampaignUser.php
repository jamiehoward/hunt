<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignUser extends Model
{
    public $table = 'campaign_user';

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function begin()
    {
        $this->started_at = date('Y-m-d H:i:s');

        $this->save();
    }

    public function getCompletionPercentageAttribute()
    {
        $incomplete = $this->campaign->incompleteClues()->count();
        $total = $this->campaign->clues->count();
        $completed = $total - $incomplete;
        return ($completed / $total) * 100;
    }

    public function nextClue()
    {
        return $this->campaign->incompleteClues()->first();
    }
}
