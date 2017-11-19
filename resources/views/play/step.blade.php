@extends('layouts.play')

@section('content')

    <clue-show v-bind:id="{{ $clue->id }}"></clue-show>
    
@endsection