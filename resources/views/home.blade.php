@extends('layouts.default')

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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User name</th>
                            <th>Full name</th>
                            <th>Email </th>
                            <th>Phone number</th>
                            <th>Role</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@stop

<!-- js -->
@section('js')
<script src="/js/home.js"></script>
@stop
