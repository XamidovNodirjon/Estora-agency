<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Log In | Adminto - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>

    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css"/>

</head>

<body class="loading authentication-bg authentication-bg-pattern">

<div class="account-pages my-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="text-center">
                    <a href="index.html">
                        <img src="logo/Estora Logo.png" alt="" height="22" class="mx-auto w-75 h-75">
                    </a>
                    <p class="text-muted mt-2 mb-4"></p>

                </div>
                <div class="card">
                    <div class="card-body p-4 border-radius-15 shadow-sm">

                        <div class="text-center mb-4">
                            <h4 class="text-uppercase mt-0">Sign In</h4>
                        </div>

                        <form action="{{route('login.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Enter Username</label>
                                <input class="form-control" name="username" type="username" id="username" required=""
                                       placeholder="Enter your username">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control" name="password" type="password" required="" id="password"
                                       placeholder="Enter your password">
                            </div>
                            <div class="mb-3 d-grid text-center">
                                <button class="btn btn-primary border-radius-15" type="submit"> Log In</button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div> 
        </div>
    </div>
</div>

<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>

<script src="assets/js/app.min.js"></script>

</body>
</html>