@extends('layouts.app')

@section('content')
    <campaign-detail v-bind:id="{{$campaign->id}}"></campaign-detail>
@endsection
