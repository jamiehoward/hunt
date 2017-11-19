@extends('layouts.play')

@section('content')

    <div class="container">
        <div class="row align-items-start">
            <div class="col">
                <div class="row text-center">
                    <div class="col text-center">
                        <h1 class="display-2">Oh no!</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col text-center">
                <div class="row">
                    <p class="lead">Seems like you put in the wrong code. Try again!</p>
                </div>
            </div>
        </div>

        <div class="row align-items-end">
            <div class="col">
                <div class="col text-center">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="e.g. ABC1234" aria-label="Answer">
                      <span class="input-group-btn">
                        <button class="btn btn-warning" type="button">Submit</button>
                      </span>
                    </div>
                </div>  
            </div>
        </div>
    </div>

@endsection