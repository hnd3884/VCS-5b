@extends('layouts.default')
@section('title', 'Home')

<!-- css -->
@section('css')
<link href="/css/home.css" rel="stylesheet">
@stop

<!-- content -->
@section('content')
<div class="container-fluid">

    <!-- DataTales Example -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Users</h6>
        </div>
        <div class="card-body">

            @if($errors->has('error'))
            <p class="text-danger">
                {{$errors->first('error')}}
            </p>
            @endif
            @if (auth()->user()->role === 2)
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addNewUser">New &nbsp<i class='far fa-plus-square'></i></a><br><br>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Full name</th>
                            <th>Email </th>
                            <th>Phone number</th>
                            <th>Role</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (auth()->user()->role === 2)
                            @foreach($users as $user)
                            <tr userid='{{$user->id}}'>
                                <td field='username' hidden>{{$user->name}} </td>

                                <td field='fullname'>{{$user->fullname}} </td>

                                <td field='email'>{{$user->email}}</td>

                                <td field='phonenumber'>{{$user->phonenumber}}</td>

                                <td field='role'>
                                    @if ($user->role === 1)
                                    Student
                                    @else
                                    <span class="text-success">Teacher</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="detail?userid={{$user->id}}" class="btn btn-success">Detail</a>&nbsp
                                    <a class='edit-user btn btn-primary' userid='{{$user->id}}' data-toggle='modal' data-target='#editUser' href='#'>edit</a>&nbsp
                                    <a class='delete-user btn btn-danger' fullname='{{$user->fullname}}' userid='{{$user->id}}' data-toggle='modal' data-target='#deleteModal' href='#'>delete</a>
                                </td>

                            </tr>
                            @endforeach
                        @else
                            @foreach($users as $user)
                            <tr userid='{{$user->id}}'>
                                <td field='username' hidden>{{$user->name}} </td>

                                <td field='fullname'>{{$user->fullname}} </td>

                                <td field='email'>{{$user->email}}</td>

                                <td field='phonenumber'>{{$user->phonenumber}}</td>

                                <td field='role'>
                                    @if ($user->role === 1)
                                    Student
                                    @else
                                    <span class="text-success">Teacher</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="detail?userid={{$user->id}}" class="btn btn-success">Detail</a>&nbsp
                                </td>

                            </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Delete <span class="text-danger" id="delete-modal-fullname"></span>?</p>
                All action delete can not roll back!
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="/delete" method="POST">
                    @csrf

                    <input name="userid" type="text" class="form-control" id="delete-userid" hidden>
                    <button class="btn btn-primary" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add New Modal-->
<div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form method="POST" action="/register">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label>User name</label>
                        <input name="name" type="text" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm password</label>
                        <input name="password_confirmation" type="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Full name</label>
                        <input name="fullname" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Phone number</label>
                        <input name="phonenumber" type="text" class="form-control" required>
                    </div>

                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input name="isteacher" class="form-check-input" type="checkbox" value="1"> Is Teacher
                        </label>
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

<!-- Edit Modal-->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form action="/update" method="POST">
                @csrf

                <input name="userid" type="text" class="form-control" id="edit-userid" hidden>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fullname">Full name</label>
                        <input name="fullname" type="text" class="form-control" id="edit-fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Email</label>
                        <input name="email" type="email" class="form-control" id="edit-email" required>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Phone number</label>
                        <input name="phonenumber" type="text" class="form-control" id="edit-phonenumber" required>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Username</label>
                        <input name="username" type="text" class="form-control" id="edit-username" required>
                    </div>
                    <div class="form-group">
                        <label for="fullname">New password</label>
                        <input name="password" type="password" class="form-control" placeholder="Leave it empty if do not want to change">
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input name="isteacher" class="form-check-input" type="checkbox" id="edit-isteacher" > Is Teacher
                        </label>
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
<script src="/js/home.js"></script>
@stop
