<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampaignUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        $campaign = Campaign::findOrFail($id);
        
        return response($campaign->players);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
            ]);

        $campaign = Campaign::findOrFail($id);

        $user = User::firstOrCreate(
            ['email' => $request->email], 
            [
                'name' => $request->name,
                'password' => bcrypt(str_random(32))
            ]
        );

        $code = strtoupper(str_random(7));

        return response($campaign->players()
            ->syncWithoutDetaching(
                [$user->id => ['code' => $code]]
            ));
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
