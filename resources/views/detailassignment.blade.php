@extends('layouts.default')
@section('title', 'Detail assignment')

<!-- css -->
@section('css')
<link href="/css/assignments.css" rel="stylesheet">
@stop

<!-- content -->
@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Assignment [ {{$assign->description}} ]</h6>
        </div>
        <div class="card-body">
            <span>File: <a href='{{"/" . $assign->filepath}}' download='{{$assign->filename}}'>{{$assign->filename}}</a></span>
            <span style="float: right;" class="text-danger">Due to: {{$assign->dueto}}</span>

            @if(auth()->user()->role == 2)
                <div>
                    <a href='#' data-toggle='modal' data-target='#changeFileModal' class='btn btn-primary'>Change file</a><br /><br />
                </div>
                <ul class='list-group'>
                    <li class='list-group-item' style='background-color: #4e73df;color: white;'>
                        <div class='row'>
                            <div class='col-3'>Time submit</div>
                            <div class='col-sm-6'>File</div>
                            <div class='col-3'>Student</div>
                        </div>
                    </li>
                    @if (count($assign->listreports)>0)
                        @foreach ($assign->listreports as $rp)
                            <li class='list-group-item'>
                                <div class='row'>
                                    <div class='col-3'>{{$rp->created_at}}</div>
                                    <div class='col-sm-6'><a href="{{$rp->filepath}}" download="{{$rp->filename}}">{{$rp->filename}}</a></div>
                                    <div class='col-3'>{{$rp->fullname}}</div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li class='list-group-item'>
                            No submit now
                        </li>
                    @endif
                </ul>

                <!-- change assignment Modal-->
                <div class="modal fade" id="changeFileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="changeassignment" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="assignid" value="{{$assign->id}}" hidden />
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="customFile">New File</label>
                                        <div class="custom-file">
                                            <input type="file" name="fileUpload" class="custom-file-input" id="customFile" required>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" href="#">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                @if (count($assign->listreports) > 0)
                    <p>
                        Turned-in file: <a href='{{$assign->listreports[0]->filepath}}' download='{{$assign->listreports[0]->filename}}'>{{$assign->listreports[0]->filename}}</a>
                        <span style='float: right;' class='text-success'><i class='fas fa-clipboard-check'></i> Turned in </span><br><br>
                        <a href='#' data-toggle='modal' data-target='#changeTurnInModal' class='btn btn-primary'>Change turn-in file</a>
                    </p>
                    <div class='modal fade' id='changeTurnInModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <form action='changereport' method='POST' enctype='multipart/form-data'>
                                    @csrf
                                    <input type='text' name='reportid' value='{{$assign->listreports[0]->id}}' hidden/>
                                    <div class='modal-body'>
                                        <div class='form-group'>
                                            <label for='customFile'>New File</label>
                                            <div class='custom-file'>
                                                <input type='file' name='fileUpload' class='custom-file-input' id='customFile' required>
                                                <label class='custom-file-label' for='customFile'>Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
                                        <button class='btn btn-primary' href='#'>Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                <br/><br/>
                <form action='addreport' method='POST' enctype='multipart/form-data'>
                    @csrf

                    <input type='text' value='{{$assign->id}}' name='assignid' hidden/>

                    <div class='form-group'>
                        <label for='customFile'>Turn in</label>
                        <div class='custom-file'>
                            <input type='file' name='fileUpload' class='custom-file-input' id='customFile' required>
                            <label class='custom-file-label' for='customFile'>Choose file</label>
                        </div>
                    </div>
                    <button class='btn btn-primary' type='submit'>Turn in</button>
                </form>
                @endif

            @endif

        </div>
    </div>
</div>
@stop

<!-- js -->
@section('js')
<script src="/js/detailassignment.js"></script>
@stop
