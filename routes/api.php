<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::resource('campaigns', 'Api\CampaignController');

    Route::get('campaigns/{id}/clues', 'Api\ClueController@index');
    Route::post('campaigns/{id}/clues', 'Api\ClueController@store');

    Route::get('campaigns/{id}/players', 'Api\CampaignUserController@index');
    Route::post('campaigns/{id}/players', 'Api\CampaignUserController@store');
    
    Route::get('clues/{clue}', 'Api\ClueController@show');
    Route::post('clues/{clue}/answers', 'Api\ClueController@storeAnswer');
    Route::delete('clues/{clue}', 'Api\ClueController@destroy');
    Route::put('clues/{clue}', 'Api\ClueController@update');
    
    Route::put('players/{player}', 'Api\PlayerController@update');
});
