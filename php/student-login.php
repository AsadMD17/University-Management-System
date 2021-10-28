<html>
<head>
    <title>Student-Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>
    <link rel="stylesheet" href="../css/login-styles.css">
</head>

<body>
    <section class="Form mt-5  mx-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 p-0">
                    <img src="../graphics/student.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-7 px-5 pt-5">
                    <!-- <h1 class="font-weight-bold py-3"> Login </h1> -->
                    <div class="media d-flex align-items-center">
                        <img src="../graphics/logo.png" alt="..." width="85" height="70" class="mr-3 logo">
                        <div class="media-body">
                            <h4 class="m-0" style="letter-spacing: 7px;">SPARX</h4>
                            <p class="font-weight-normal text-muted mb-0">Classroom-Student Panel</p>
                        </div>
                    </div>
                    <form method="POST" action="">
                        <div class="form-row">
                            <div class="col-lg-7">
                                <h6 class="mt-5 mb-2">Roll-No </h6>
                                <input id="auto-name" type="text" placeholder="XXF-XXXX" name="username" class="form-control my-2 p-4" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <h6>Password</h6>
                                <input id="auto-password" type="password" placeholder="******" name="password" class="form-control my-2 p-4" required>
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input mt-4 p-4" name="remember" id="remembercheck">
                            <label for="remembercheck" class="form-check-label mt-3"> Remember me</label>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <button type="submit" class="btn my-4 bg-success" style="color: white;" name="submit">Login</button>
                            </div>
                        </div>
                        <h5 id="invalid"></h5>
                        <p style="color: rgb(156, 0, 0);" class="font-weight-bold"> Don't have an account?<br> Ask the management to handle your queries!</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
<?php

include 'db.php';
include 'login.php';
$obj =  new login($conn);

$obj->autofill("student_credentials");

if (isset($_POST['submit'])) {
    
    $obj->validate("student_credentials");
    $conn = null;
}?>