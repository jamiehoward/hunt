@extends('layouts.app')

@section('content')
    <campaign-detail v-bind:id="{{$campaign->id}}"></campaign-detail>

    <div class="container">
        <div class="row">
            <div class="col-10">
                <clue-list v-bind:campaign="{{$campaign->id}}"></clue-list>
            </div>

            <div class="col-2">
                Here is the sidebar
            </div>
        </div>
    </div>
@endsection
