<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Class Manager</title>

    <link href="/lib/fontawesome/css/all.css">
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/css/sidebar.css" rel="stylesheet">
    @yield('css')
    <!--load all styles -->
</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        @include('includes.sidebar')
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    @include('includes.navbar')
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    @yield('content')
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

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
                    <a id="delete-user-forward" class="btn btn-primary" href="#">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Modal-->
    <div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form action="../controllers/AddUserController.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fullname">Full name</label>
                            <input name="fullname" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Email</label>
                            <input name="email" type="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Phone number</label>
                            <input name="phonenumber" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Username</label>
                            <input name="username" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Password</label>
                            <input name="password" type="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fullname">Repeat password</label>
                            <input name="repeatpassword" type="password" class="form-control" required>
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input name="isteacher" class="form-check-input" type="checkbox"> Is Teacher
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

                <form action="../controllers/EditUserController.php" method="POST">
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
                            <input name="password" type="password" class="form-control" id="edit-password" placeholder="Leave it empty if do not want to change">
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input name="isteacher" class="form-check-input" type="checkbox" id="edit-isteacher"> Is Teacher
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


    <!-- Bootstrap core JavaScript-->
    <script defer src="/lib/fontawesome/js/all.js"></script>
    <script src="/lib/jquery/jquery-3.5.1.min.js"></script>
    <script src="/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/sidebar.js"></script>
    @yield('js')

</body>

</html>
