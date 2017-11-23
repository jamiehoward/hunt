@extends('layouts.play')

@section('content')

    <div class="container">
        <div class="row align-items-start">
            <div class="col text-center">
                &nbsp;
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col">
                <div class="row text-center">
                    <div class="col text-center">
                        <h1 class="display-2">{{ $campaign->introduction }}</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-center">
                        <a href="#" onclick="window.location.reload()" class="btn btn-lg btn-info">Begin!</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col">
                &nbsp;    
            </div>
        </div>
    </div>

@endsection