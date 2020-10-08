@extends('layouts.default')
@section('title', 'Messages')

<!-- css -->
@section('css')
@stop

<!-- content -->
@section('content')
<div class="container" style="width: 70%; padding: 15px;">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Received messages</h6>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class='list-group-item' style="color: white; background-color: #4e73df">
                    <div class='row'>
                        <div class='col-3'>Time</div>
                        <div class='col-sm-7'>Content</div>
                        <div class='col-2'>From</div>
                    </div>
                </li>

                @if (count($messages) == 0)
                    <li class='list-group-item'>
                        No received message now
                    </li>
                @else
                    @foreach ($messages as $mess)
                        <li class='list-group-item'>
                            <div class='row'>
                                <div class='col-3'>{{$mess->created_at}}</div>
                                <div class='col-sm-7'>{{$mess->content}}</div>
                                <div class='col-2'>{{$mess->sendname}}</div>
                            </div>
                        </li>
                    @endforeach
                @endif

            </ul>
        </div>
    </div>
</div>
@stop

<!-- js -->
@section('js')
@stop

