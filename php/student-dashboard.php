<?php
include 'student.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['student_credentials'])) {
    header('location:student-login.php');
}


$temp = $_SESSION['student_credentials'];
$obj = new add($conn);
$user_data = $obj->get_picture($temp, "student_information");
$Pic = $user_data['P'];
$Name = $user_data['N'];

$obj = new course_registeration($conn);
$obj->get_semester($temp);
$c = $obj->get_courses();



$att = new attendance($conn);
$reg = $att->get_registerated_courses();



if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header("Location:student-login.php");
    exit;
} ?>

<html>

<head>
    <title>Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <!-- Vertical navbar -->
    <div class="vertical-nav bg-white" id="sidebar">
        <div class="py-4 px-3 ">
            <div class="media d-flex align-items-center">
                <img src="../graphics/logo.png" alt="..." width="65" height="50" class="mx-3">
                <div class="media-body">
                    <h4 class="m-0" style="letter-spacing: 9px;">SPARX</h4>
                    <p class="font-weight-normal text-muted mb-0">Classroom</p>
                </div>
            </div>
        </div>
        <div class="pb-1 px-3 mb-4 ">
            <div class="media d-flex justify-content-center">
                <img id="Profile-Pic" src="../graphics/profile.jpg" alt="..." width="70" class="img-fluid rounded-circle">
            </div>
            <div class="" style="margin: auto;width:auto; text-align: center;">
                <a href="#drop-down-user" id="logout_btn" data-toggle="collapse" aria-expanded="false" class=" dropdown-toggle text-dark py-2"> User_Name </a>
                <div class="collapse" id="drop-down-user">
                    <form method="POST" action="">
                        <a href="#"> <i class="fa fa-drivers-license-o  text-gray fa-fw drop-down-content pt-2"> My Profile</i></a>
                        <a href="#"> <i class="fa fa-gear  text-gray fa-fw drop-down-content"> Change Password</i></a>
                        <hr>
                        <input type="submit" class="logout-style drop-down-content mb-2" name="logout" value="logout" />
                    </form>
                </div>
                <script>
                    document.getElementById('logout_btn').innerHTML = "<?PHP echo "Hello Mr, " . $Name; ?>";
                    document.getElementById('Profile-Pic').src = "<?PHP echo $Pic; ?>";
                </script>

            </div>
        </div>
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-1 mb-0">Panel</p>

        <ul class="nav   flex-column bg-white mb-0">
            <li class="nav-item">
                <a data-toggle="tab" href="#view-presonal" class="nav-link text-dark">
                    <i class="fa fa-search mr-3 text-primary fa-fw"></i> Personal info </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" id="course-register" href="#course-register-form" class="nav-link text-dark">
                    <i class="fa fa-user-plus mr-3 text-primary fa-fw"></i> Course Registeration
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" id='attendance_btn' href="#attendance" class="nav-link text-dark">
                    <i class="fa fa-remove mr-3 text-primary fa-fw"></i> Attendance
                </a>
            </li>
       

            <div class="mb-4"></div>
        </ul>
    </div>
    <!-- End vertical navbar -->


    <!--Form holder -->
    <div class="page-content p-5" id="content">
        <!-- Toggle button -->
        <div class="">
            <a id="sidebarCollapse" class="mb-4"><i class="fa fa-bars mr-2 mb-4" style="font-size: 25px;cursor: pointer;"></i></a>
        </div>

        <div class="tab-content">
            <!-- Personal info  -->
            <div id="view-presonal" class="tab-pane fade ">
                <h2 class="display-5 text-black-50 "> Personal info </h2>
            </div>
            <!-- Register courses -->
            <div id="course-register-form" class="tab-pane fade ">
                <h2 class="display-5 text-black-50 ">Register Courses</h2>

                <div>
                    <form method="POST" action="student.php">
                        <div class="table-responsive-md">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Course ID</th>
                                        <th>Name</th>
                                        <th>Section</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $mycheck ="";
                                    foreach ($c as $r => $link) {
                                        $check = false;
                                        $mycheck ="";
                                        foreach ($reg as $courses => $l){
                                                 if($l['CID'] == $link['I'] )
                                                 {  $check= true;
                                                    $mycheck= "disabled";
                                                 }
                                        }
                                        ?>
                                        <tr>

                                            <td><?= $link['I'] ?></td>
                                            <td><?= $link['N'] ?></td>
                                            <td>
                                                <select name="<?= $link['I'] ?>" class="form-control text-muted" >
                                                    <?php
                                                    $sections = $obj->get_sections($link['I']);
                                                    foreach ($sections as $section) {
                                                    ?>
                                                        <option value="<?= $section['section'] ?>"><?= $section['section'] ?></option>
                                                    <?php } ?>

                                                </select></td>
                                            <td class="text-center">
                                          
                                                <div class="form-check">
  
                                                    <input type="checkbox" class="form-check-input mt-2 big-checkbox " name="selection[]" value="<?= $link['I'] ?>" id="remembercheck " <?= $mycheck ?> >
                                                </div>
                                            </td>
                                        </tr>
                                    <?php 
                                       
                                   }  ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-row ">
                            <div class=offset-10>
                            </div>
                            <div class="col-lg-1 ml-5 text-right ">
                                <button type="submit" class="btn my-4 bg-success " style="color: white;" name="reg-courses">Register</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <!-- End Register Course -->

            <!-- View Attendance -->
            <div id="attendance" class="tab-pane fade ">
                <h2 class="display-5 text-black-50 "> Attendance </h2>


                <div class="table-responsive-lg">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Course ID</th>
                                <th>Attendence</th>
                            </tr>
                        </thead>
                        <tbody class="attendence_data" id="attendance_table">
                            <?php foreach ($reg as $I => $data) {
                            ?>
                                <tr>
                                    <td class="course_id"><?= $data['CID'] ?></td>
                                    <td>
                                        <a href="#" class="badge btn-info attendance_view_btn" name="a">View</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>


                <!-- End View Teacher -->



                <!-- Add Course -->
                <div id="marks" class="tab-pane fade">
                    <h2 class="display-5 text-black-50 "> Marks</h2>
                </div>
            </div>


            <div class="modal fade bd-example-modal-lg " id="attendance_view_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="ModalLabel">Attendance Details</h5>

                        </div>
                        <div class="modal-body scroll">

                            <div class="container-fluid">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover ">

                                        <thead>
                                            <tr>
                                                <th> Serial No </th>
                                                <th> Date </th>
                                                <th> Status </th>
                                            </tr>
                                        </thead>
                                        <tbody class="attendence_model" id="attendance_model_details">


                                        </tbody>
                                    </table>
                                </div>

                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        </div>
                    </div>
                </div>


            </div>






</body>

</html>