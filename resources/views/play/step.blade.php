@extends('layouts.play')

@section('content')

    <clue-show v-bind:id="{{ $clue->id }}" v-bind:percentage="{{ $percentage }}"></clue-show>
    
@endsection