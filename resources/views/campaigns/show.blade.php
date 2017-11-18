@extends('layouts.app')

@section('content')
    <campaign-detail v-bind:id="{{$campaign->id}}"></campaign-detail>
    <clue-list v-bind:campaign="{{$campaign->id}}"></clue-list>
@endsection
