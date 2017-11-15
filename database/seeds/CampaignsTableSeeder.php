<?php

use App\Models\Campaign;
use Illuminate\Database\Seeder;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('campaigns')->truncate();

        factory(Campaign::class, 25)->create([
            'user_id' => 1
            ]);
    }
}
