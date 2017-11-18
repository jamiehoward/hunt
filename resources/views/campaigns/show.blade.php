@extends('layouts.app')

@section('content')
    <campaign-detail v-bind:id="{{$campaign->id}}"></campaign-detail>

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <clue-list v-bind:campaign="{{$campaign->id}}"></clue-list>
            </div>

            <div class="col-lg-3">
                <player-list v-bind:campaign="{{$campaign->id}}"></player-list>
            </div>
        </div>
    </div>
@endsection
