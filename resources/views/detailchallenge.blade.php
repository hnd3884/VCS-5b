@extends('layouts.default')
@section('title', 'Detail assignment')

<!-- css -->
@section('css')
<link href='/css/challenge.css' rel='stylesheet'>
@stop

<!-- content -->
@section('content')
<div class='container-fluid'>

    @if (auth()->user()->role == 2)
        <div class='card shadow mb-4'>
        <div class='card-header py-3'>
            <h6 class='m-0 font-weight-bold'>{{$challenge->challengename}}</h6>
        </div>
        <div class='card-body'>
            <h4 class='text-success'>Hint <i class='fas fa-lightbulb'></i></h4>
            <p>{{$challenge->hint}}</p>
            <h4>All submits</h4>
            <ul class='list-group'>
                <li class='list-group-item' style='color: white; background-color: #4e73df'>
                    <div class='row'>
                        <div class='col-3'>Time</div>
                        <div class='col-sm-7'>Student</div>
                        <div class='col-2'>Result</div>
                    </div>
                </li>

                @if (count($challenge->histories) > 0)
                    @foreach ($challenge->histories as $history)

                        <li class='list-group-item'>
                            <div class='row'>
                                <div class='col-3'>{{$history->created_at}}</div>
                                <div class='col-sm-7'>{{$history->fullname}}</div>

                        @if ($history->result == 1)
                                <div class='col-2'><span class='text-success'>Correct</span></div>
                            </div>
                        </li>
                        @else
                                <div class='col-2'><span class='text-danger'>Incorrect</span></div>
                            </div>
                        </li>
                        @endif

                    @endforeach
                @else
                    <li class='list-group-item'>
                        No received message now
                    </li>
                @endif


            </ul>
        </div>
    </div>
    @else
        <div class='container' style='text-align: center; width: 700px;'>
        <h5>Challenge</h5>
        <h1 style='font-size: 55px;'>{{$challenge->challengename}}</h1>
        <a type='text' class='btn btn-primary' href='#' data-toggle='modal' data-target='#showHint'>Show hint <i class='fas fa-lightbulb'></i></a>

        <form action='/challenges/answer' method='POST' style='width:450px; margin-left: 110px'>
            @csrf
            <hr>
            <input type='text' name='chalid' value='{{$challenge->id}}' hidden>
            <div class='form-group'>
                <input type='text' class='form-control' name='answer' placeholder='Type your answer' required autofocus>
            </div>
            <div class='form-group'>
                <button type='text' class='btn btn-primary'>Submit</button>
            </div>
        </form>

        @if (session('result'))

            @if (session('result') == 'true')
                <p class='text-success'>Congratulation, correct answer !</p>
                </div>
                <div class='container' style='width:75%'>
                    <div class='card shadow mb-4'>
                    <div class='card-header py-3'>
                        <h6 class='m-0 font-weight-bold text-primary'>Your reward</h6>
                    </div>
                    <div class='card-body'>
                        @php
                            $file = fopen(session('filepath'), "r");
                        @endphp
                        @while (!feof($file))
                            {{fgets($file)}}<br/>
                        @endwhile
                        @php
                            fclose($file);
                        @endphp
                    </div>
                </div>
            @else
                <p class='text-danger'>Incorrect answer !</p>
            @endif

        @endif
    @endif


</div>

<!-- Show hint modal-->
<div class='modal fade' id='showHint' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-body'>
                {{$challenge->hint}}
            </div>
            <div class='modal-footer'>
                <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
            </div>
        </div>
    </div>
</div>

@stop

<!-- js -->
@section('js')

@stop
