@extends('layouts.play')

@section('content')

    <div class="container">
        <div class="row align-items-start">
            <div class="col">
                &nbsp;
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col">
                <div class="row text-center">
                    <div class="row">
                        <div class="col text-center">
                            <h1 class="display-2">Congratulations!</h1>
                            <p class="lead">{{$code->campaign->resolution_text}}</p>
                            @if (!is_null($code->campaign->resolution_link))
                            <a href="{{$code->campaign->resolution_link}}"class="btn btn-lg btn-info" target="_blank">
                                Claim your prize
                            </a>
                            @endif
                        </div>
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