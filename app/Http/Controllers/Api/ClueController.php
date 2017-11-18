<?php

namespace App\Http\Controllers\Api;

use App\Models\Clue;
use App\Models\Campaign;
use App\Http\Controllers\Controller;

class ClueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        $campaign = Campaign::findOrFail($id);
        return response($campaign->clues);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clue  $clue
     * @return \Illuminate\Http\Response
     */
    public function show(Clue $clue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clue  $clue
     * @return \Illuminate\Http\Response
     */
    public function edit(Clue $clue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clue  $clue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clue $clue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clue  $clue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clue $clue)
    {
        //
    }
}
