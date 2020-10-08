@extends('layouts.default')
@section('title', 'Detail user')

<!-- css -->
@section('css')
<link href="/css/detailuser.css" rel="stylesheet">
@stop

<!-- content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <img style="width: 91%;" src="/assets/images/user_icon.png" alt="" class="img-rounded img-responsive" />
        </div>
        <div class="col">
            <blockquote>
                <h1>{{$user->fullname}}</h1>
                <small>
                    <cite title="Source Title">

                        @if ($user->role === 1)
                            Student
                        @else
                            Teacher
                        @endif

                    <i class="glyphicon glyphicon-map-marker"></i>
                    </cite>
                </small>
            </blockquote>
            <p>
                <i class="fas fa-envelope-open-text"></i> &nbsp;{{$user->email}}
                <br /> <i class="fas fa-phone-square"></i> &nbsp;{{$user->phonenumber}}
            </p>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Send message</h6>
                    @if(session('message'))
                        <span class="text-success">
                            {{session('message')}}
                        </span>
                    @endif
                </div>
                <div class="card-body">
                    <form action="sendmessage" method="POST">
                        @csrf
                        <input type="text" name="receiveid" hidden value="{{$user->id}}" />
                        <div class="col">
                            <textarea name="message" required></textarea>
                        </div>
                        <div class="col">
                            <button style="float: right;" class="btn btn-primary" type="submit">Send <i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Messages sent to {{$user->fullname}}</h6>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class='list-group-item' style="color: white; background-color: #4e73df">
                    <div class='row'>
                        <div class='col-3'>Time</div>
                        <div class='col-sm-7'>Content</div>
                        <div class="col-2" style="text-align: center">#</div>
                    </div>
                </li>
                @if(count($messages) == 0)
                    <li class='list-group-item'>
                        No message sent
                    </li>
                @else
                    @foreach ($messages as $mess)
                        <li class='list-group-item'>
                            <div class='row'>
                                <div class='col-3'>{{$mess->created_at}}</div>
                                <div messid='{{$mess->id}}' class='col-sm-7'>{{$mess->content}}</div>
                                <div class='col-2'>
                                    <a messid='{{$mess->id}}' userid='{{$user->id}}' data-toggle='modal' data-target='#deleteMessModal' href='#' class='btn btn-danger delete-mess'><i class='fas fa-trash-alt'></i></a>
                                    <a messid='{{$mess->id}}' content='{{$mess->content}}' class='btn btn-primary edit-mess' data-toggle='modal' data-target='#editMessModal' href='#'><i class='fas fa-pencil-alt'></i></a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif

            </ul>
        </div>
    </div>
</div>

<!-- Delete Message Modal-->
<div class="modal fade" id="deleteMessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                All deleted messages can not be rolled back!
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="/deletemessage" method="POST">
                    @csrf

                    <input name="userid" type="text" class="form-control" id="delete-userid" hidden>
                    <input name="messid" type="text" class="form-control" id="delete-messid" hidden>
                    <button class="btn btn-primary" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Message Modal-->
<div class="modal fade" id="editMessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit message</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/editmessage" method="POST">
                @csrf
                <input type="text" name="userid" value="{{$user->id}}" hidden />
                <input type="text" name="messid" hidden />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Message</label>
                        <textarea name="newmessage" class="form-control" id="exampleInputPassword1"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

@stop

<!-- js -->
@section('js')
<script src="/js/detailuser.js"></script>
@stop

