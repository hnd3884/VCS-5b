@extends('layouts.default')
@section('title', 'Profile')

<!-- css -->
@section('css')
<link href="/css/detailuser.css" rel="stylesheet">
@stop

<!-- content -->
@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="m-0 font-weight-bold">Profile</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img style="width: 100%;" src="/assets/images/user_icon.png" alt="" class="img-rounded img-responsive" />
                </div>
                <div class="col">
                    <blockquote>
                        <h1>{{$user->fullname}}</h1>
                        <small><cite title="Source Title">
                            @if ($user->role === 1)
                                Student
                            @else
                                Teacher
                            @endif
                            <i class="glyphicon glyphicon-map-marker"></i>
                        </cite></small>
                    </blockquote>
                    <p>
                        <i class="fas fa-envelope-open-text"></i> &nbsp;{{$user->email}}
                        <br /> <i class="fas fa-phone-square"></i> &nbsp;{{$user->phonenumber}}
                    </p>
                    <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#changeProfileModal">Change profile</a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Change profile Modal-->
<div class="modal fade" id="changeProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Change profile {{$user->fullname}}</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/profile" method="POST">
                @csrf

                <input type="text" name="userid" value="{{$user->id}}" hidden>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">New password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Leave it empty if do not want to change password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Phone number</label>
                        <input type="text" name="phonenumber" value="{{$user->phonenumber}}" class="form-control" id="exampleInputPassword1">
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
@stop
