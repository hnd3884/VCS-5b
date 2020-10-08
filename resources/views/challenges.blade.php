@extends('layouts.default')
@section('title', 'Detail assignment')

<!-- css -->
@section('css')
<link href="/css/challenge.css" rel="stylesheet">
@stop

<!-- content -->
@section('content')
<div class="container">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Challenges</h6>

        </div>
        <div class="card-body">

            @if (auth()->user()->role == 2)
                <a class='btn btn-primary' href='#' data-toggle='modal' data-target='#addChallenge'>New &nbsp <i class='far fa-plus-square'></i></a><br><br>
            @endif

            <ul class="list-group">
                <li class='list-group-item' style="color: white; background-color: #4e73df">
                    <div class='row'>
                        <div class='col-sm-8'>Challenge name</div>
                        <div class='col-2'>#</div>
                    </div>
                </li>
                @if (auth()->user()->role == 2)
                    @if (sizeof($challenges) == 0)
                        <li class='list-group-item'>
                            No challenge available now
                        </li>
                    @else
                        @foreach ($challenges as $chal)
                            <li class='list-group-item'>
                                <div class='row'>
                                <div class='col-sm-8'>{{$chal->challengename}}</div>
                                    <div class='col-3'>
                                        <a class='btn btn-success' href='/challenges/detail?chalid={{$chal->id}}'>Detail</a>
                                        <a class='btn btn-danger delete-challenge' chalid='{{$chal->id}}' href='#' data-toggle='modal' data-target='#deleteAssignmentModal'>Delete</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                @else
                    @if (sizeof($challenges) == 0)
                        <li class='list-group-item'>
                            No challenge available now
                        </li>
                    @else
                        @foreach ($challenges as $chal)
                            <li class='list-group-item'>
                                <div class='row'>
                                    <div class='col-sm-8'>{{$chal->challengename}}</div>
                                    <div class='col-2'>
                                        <a class='btn btn-success' href='/challenges/detail?chalid={{$chal->id}}'>Detail</a>
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

<!-- Create challenge modal-->
<div class="modal fade" id="addChallenge" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="addchallenge" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Challenge name</label>
                        <input type="text" name="challengename" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Hint</label>
                        <textarea type="text" name="hint" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="customFile">Challenge file</label>
                        <div class="custom-file">
                            <input type="file" name="fileUpload" class="custom-file-input" id="customFile" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Create</button>
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
                All deleted can not be rolled back!
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="deletechallenge" method="POST">
                    @csrf

                    <input name="challengeid" type="text" class="form-control" id="delete-challenge-forward" hidden>
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

<!-- js -->
@section('js')
<script src="/js/challenge.js"></script>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@stop
