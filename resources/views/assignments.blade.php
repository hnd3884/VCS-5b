@extends('layouts.default')
@section('title', 'Assignments')

<!-- css -->
@section('css')
<link href="/lib/datetimepicker-master/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css">
<link href="/css/addassignment.css" rel="stylesheet">
@stop

<!-- content -->
@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">List Assignments</h6>
        </div>
        <div class="card-body">

            @if (auth()->user()->role == 2)
                <a data-toggle='modal' data-target='#addAssignmentModal' href='#' class='btn btn-primary'>New &nbsp<i class='far fa-plus-square'></i></a><br/><br/>
            @endif

            <ul class="list-group">
                <li class='list-group-item' style="background-color: #4e73df;color: white;">
                    <div class="row">
                        <div class='col-3'>Due to</div>
                        <div class='col-sm-6'>Description</div>
                        <div class='col-3'>#</div>
                    </div>
                </li>
                @if (auth()->user()->role == 2)
                    @if (count($assignments) == 0)
                        <li class='list-group-item'>
                            No assignments available now
                        </li>
                    @else
                        @foreach ($assignments as $assign)
                            <li class='list-group-item'>
                                <div class='row'>
                                    <div class='col-3'>{{$assign->dueto}}</div>
                                    <div class='col-sm-6'>{{$assign->description}}</div>
                                    <div class='col-3'>
                                        <a class='btn btn-success' href='detailassignments?assignid={{$assign->id}}'>Detail</a>
                                        <a class='btn btn-danger delete-assignment' assignid='{{$assign->id}}' href='#' data-toggle='modal' data-target='#deleteAssignmentModal'>Delete</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                @else
                    @if (count($assignments) == 0)
                        <li class='list-group-item'>
                            No assignments available now
                        </li>
                    @else
                        @foreach ($assignments as $assign)
                            <li class='list-group-item'>
                                <div class='row'>
                                    <div class='col-3'>{{$assign->dueto}}</div>
                                    <div class='col-sm-6'>{{$assign->description}}</div>
                                    <div class='col-3'>
                                        <a class='btn btn-success' href='detailassignments?assignid={{$assign->id}}'>Detail</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                @endif

            </ul>
        </div>
    </div>
</div>

{{-- Add new assignment --}}
<div class="modal fade" id="addAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/addassignment" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label for="fullname">Description</label>
                        <input name="description" type="text" class="form-control" id="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="customFile">File</label>
                        <div class="custom-file">
                            <input type="file" name="fileUpload" class="custom-file-input" id="customFile" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="customFile">Due to</label>
                        <input id="datetimepicker" class="form-control" name="dueto" type="text" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" name="submit">Create</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="deleteAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                All submits from students will be deleted as well!
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="/deleteassignment" method="POST">
                    @csrf

                    <input name="assignid" type="text" class="form-control" id="delete-assignid" hidden>
                    <button class="btn btn-primary" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

<!-- js -->
@section('js')
<script src="/js/home.js"></script>
<script src="/lib/bootstrap/js/moment.min.js"></script>
<script src="/lib/datetimepicker-master/jquery.datetimepicker.full.min.js"></script>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $(function() {
        $('#datetimepicker').datetimepicker();
    });
</script>
@stop
