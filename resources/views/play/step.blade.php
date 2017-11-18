@extends('layouts.play')

@section('content')

    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg-4 offset-lg-4 text-center">
                <div class="progress" style="height:2px;">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col">
                <div class="row text-center">
                    <div class="col text-center">
                        <h1 class="display-2">{{ $clue->label }}</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 offset-lg-4 text-center">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Answer" aria-label="Answer">
                          <span class="input-group-btn">
                            <button class="btn btn-warning" type="button">Guess!</button>
                          </span>
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