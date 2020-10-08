<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/login.css" rel="stylesheet">
    <title>Login</title>
</head>

<body class="bg-gradient-primary">

    <div class="banner">
        <div class="form-login">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
            </div>

            @if($errors->any())
            <p class="text-danger">
                {{$errors->first()}}
            </p>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="form-group">
                    <label>User name</label>
                    <input type="text" name="name" :value="old('name')" class="form-control form-control-user" id="exampleInputEmail" placeholder="Enter User Name..." required autofocus>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter Password..." required>
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    Login
                </button>

            </form>

        </div>

    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="../lib/jquery/jquery-3.5.1.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
