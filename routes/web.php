<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function() {
    return redirect('campaigns');
});

Route::group(['middleware' => 'auth'], function() {
    Route::resource('campaigns', 'CampaignController');
});

Route::get('/{code}', 'PlayController@index');
Route::get('/play/{code}', 'PlayController@show');