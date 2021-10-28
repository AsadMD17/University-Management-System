<?php
include 'admin.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_credentials'])) {
    header('location:admin-login.php');
}


$temp = $_SESSION['admin_credentials'];
$info = new get($conn);
$s_info = $info->get_students();
$t_info = $info->get_teacher();
$c_info = $info->get_courses();
$ct_info = $info->get_course_teacher();

if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header("Location:admin-login.php");
    exit;
} ?>

<html>

<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- For jquery and ajax effects -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- For tooltips and modals -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- For bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>
    <link rel="stylesheet" href="../css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('#mytab a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>


</head>

<body>
    <div class="top-border">

    </div>
    <!-- Vertical navbar -->
    <div class="vertical-nav" id="sidebar">
        <div class="py-4 px-3 ">
            <div class="media d-flex align-items-center">
                <img src="../graphics/logo2.png" alt="..." width="65" height="50" class="mx-2">
                <div class="media-body">
                    <p class="m-0 font-weight-bold text-light" style="letter-spacing: 11px;font-size:15px">SPARX</p>
                    <p class="font-weight-normal text-gray mb-0">Classroom</p>
                </div>
            </div>

        </div>
        <div class="pb-1 px-3 ">
            <div class="media d-inline">
                <img src="../graphics/admin.jpg" alt="..." class="photo d-inline">

                <div class=" text-primary d-inline pl-3" style="margin: auto;width:auto;">
                    <a href="#drop-down-user" id="logout_btn" data-toggle="collapse" aria-expanded="false" class="no-border dropdown-toggle text-dark py-2"> User_Name </a>
                    <div class="collapse" id="drop-down-user">
                        <form method="POST" action="">


                            <button type="submit" class="logout-style drop-down-content mb-2" name="logout"><i class="fa fa-power-off"></i> logout</button>

                        </form>
                    </div>
                    <hr>
                    <script>
                        document.getElementById('logout_btn').innerHTML = "<?PHP echo "" . $temp; ?>";
                    </script>
                </div>
            </div>
        </div>
        <p class="text-gray font-weight-bold text-uppercase px-3 pb-1 small">Teachers</p>

        <ul class="nav   flex-column mb-0 " id='mytab'>
            <li class="nav-item">
                <a data-toggle="tab" href="#view-teacher" class="nav-link text-dark">
                    <i class="fa fa-database mr-3 text-primary fa-fw pt-2"></i> Records
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" href="#Add-teacher" class="nav-link text-dark">
                    <i class="fa fa-user-plus mr-3 text-primary fa-fw"></i> Add
                </a>
            </li>


            <p class="text-gray font-weight-bold text-uppercase px-3 small  pt-3 pb-1 mb-0">Students</p>

            <li class="nav-item">
                <a data-toggle="tab" href="#view-student" class="nav-link text-dark">
                    <i class="fa fa-database mr-3 text-primary fa-fw"></i> Records
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" href="#Add-student" class="nav-link text-dark">
                    <i class="fa fa-user-plus mr-3 text-primary fa-fw"></i> Add
                </a>
            </li>




            <p class="text-gray font-weight-bold text-uppercase px-3 small  pt-3 pb-1 mb-0">Courses</p>


            <li class="nav-item">
                <a data-toggle="tab" href="#view-course" class="nav-link text-dark" id="display_students">
                    <i class="fa fa-database mr-3 text-primary fa-fw"></i> Records
                </a>

            </li>
            <li class="nav-item">
                <a data-toggle="tab" href="#add-course" class="nav-link text-dark">
                    <i class="fa fa-book mr-3 text-primary fa-fw"></i> Add
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" href="#assign-course" class="nav-link text-dark">
                    <i class="	fa fa-chevron-right mr-3 text-primary fa-fw"></i> Assign Teacher
                </a>
            </li>


            <p class="text-gray font-weight-bold text-uppercase px-3 small  pt-3 pb-1 mb-0">Accessibility</p>


            <li class="nav-item ">

                <a data-toggle="tab" href="#change_password" class="nav-link pass text-dark">
                    <i class="fa fa-gear mr-3 text-primary fa-fw "> </i>Change Password</a>
            </li>



            <div class="mb-4"></div>
        </ul>

    </div>
    <!-- End vertical navbar -->


    <!--Form holder -->
    <div class="page-content p-5" id="content">
        <!-- Toggle button -->
        <div class="position-fixed">
            <a id="sidebarCollapse" class="toggle_button"><i class="fa fa-bars"></i></a>
        </div>

        <div class="tab-content ">
            <!-- Add Student -->

            <div id="Add-student" class="tab-pane fade active">
                <!-- Personal Information -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card card_style">
                            <div class="card-header card_heading">
                                <div class="title ">
                                    <h5 class="display-5 text-gray text-center pt-3">Student Registration</h5>
                                </div>

                            </div>
                            <div class="card-body">
                                <h6 class="subheading">Personal Information</h6>
                                <form method="post" action="admin.php" id="s-add" enctype="multipart/form-data">
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name-student" class="form-control text-gray input_style" maxlength="15" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Father Name</label>
                                                <input type="text" name="father-student" class="form-control text-gray input_style" maxlength="15" required>
                                            </div>
                                        </div>
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>CNIC</label>
                                                <input type="text" name="CNIC-student" class="form-control text-gray input_style" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" max-length="13" pattern="[1-9]{2}[0-9]{3}-[0-9]{7}-[1-9]{1}" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Blood Group</label>
                                                <select name="BloodGroup-student" class="form-control text-gray input_style" required>
                                                    <option value="A+">A+</option>
                                                    <option value="B+">B+</option>
                                                    <option value="O+">O+</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="B-">B-</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="date" name="DOB-student" class="form-control text-gray input_style" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="gender-student" form="s-add" class="form-control text-gray input_style" required>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="text" name="Contact-student" class="form-control text-gray input_style" data-inputmask="'mask': '0399-9999999'" type="number" placeholder="03XX-XXXXXXX" pattern="[0-3]{2}[0-9]{2}-[0-9]{7}" required>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Professional Information -->
                                    <h6 class="subheading">Professional Information</h6>
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Batch</label>
                                                <input type="number" name="Batch-student" class="form-control text-gray input_style" min="1" max="99" required>
                                            </div>
                                        </div>

                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Semester</label>
                                                <select name="Semester-student" class="form-control text-gray input_style" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select name="Dept-student" class="form-control text-gray input_style" required>
                                                    <option value="Computer Science">Computer Science</option>
                                                    <option value="Electrical Engineering">Electrical Engineering</option>
                                                    <option value="Software Engineering">Software Engineering</option>
                                                    <option value="Sciences and Humanities">Sciences and Humanities</option>
                                                    <option value="School Of Management">School Of Management</option>
                                                    <option value="Civil Engineering">Civil Engineering</option>
                                                    <option value="Visual Arts">Visual Arts</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Degree</label>
                                                <select name="Degree-student" form="s-add" class="form-control text-gray input_style" required>
                                                    <option value="BS-CS">BS-CS</option>
                                                    <option value="BS-SE">BS-SE</option>
                                                    <option value="BBA">BBA</option>
                                                    <option value="BS-EE">BS-EE</option>
                                                    <option value="BS-CE">BS-CE</option>
                                                    <option value="B.V.A.">B.V.A.</option>
                                                    <option value="MS-CS">MS-CS</option>
                                                    <option value="MS-SE">MS-SE</option>
                                                    <option value="MBA">MBA</option>
                                                    <option value="MS-EE">MS-EE</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="email" name="Email-student" class="form-control text-gray input_style" required>
                                            </div>
                                        </div>
                                        <div class="offset-lg-4">
                                        </div>
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Upload Profile Picture</label>
                                                <div class="custom-file">
                                                    <input type="file" name="Picture-student" id="Picture-student" class="custom-file-input input_style" required>
                                                    <label class="custom-file-label">Choose image</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn mt-4 btn-fill bg-success " style="color: white;" name="Submit-student" value="Register" />
                                </form>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
            <!-- End Add Student -->

            <!-- Add Teacher -->
            <div id="Add-teacher" class="tab-pane fade ">

                <!-- Personal Information -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card card_style">
                            <div class="card-header card_heading">
                                <div class="title">
                                    <h5 class="display-5 text-gray text-center pt-3">Teacher Registration</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="subheading">Personal Information</h6>
                                <form method="post" action="admin.php" id="t-add" enctype="multipart/form-data">
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name_teacher" class="form-control text-gray input_style" maxlength="15" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Father Name</label>
                                                <input type="text" name="Father_teacher" class="form-control text-gray input_style" maxlength="15" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="text" name="Contact_teacher" class="form-control text-gray input_style" data-inputmask="'mask': '0399-9999999'" type="number" placeholder="03XX-XXXXXXX" pattern="[0-3]{2}[0-9]{2}-[0-9]{7}" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Blood Group</label>
                                                <select name="Blood_teacher" form="t-add" class="form-control text-gray input_style" required>
                                                    <option value="A+">A+</option>
                                                    <option value="B+">B+</option>
                                                    <option value="O+">O+</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="B-">B-</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class=" col-lg-3">
                                            <div class="form-group">
                                                <label>CNIC</label>
                                                <input type="text" name="CNIC_teacher" class="form-control text-gray input_style" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" max-length="13" pattern="[1-9]{2}[0-9]{3}-[0-9]{7}-[1-9]{1}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="Gender_teacher" form="t-add" class="form-control text-gray input_style" required>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="date" name="DOB_teacher" class="form-control text-gray input_style" required>
                                            </div>
                                        </div>


                                    </div>

                                    <!-- Professional Information -->


                                    <h6 class="subheading">Professional Information</h6>
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select name="Dept_teacher" class="form-control text-gray input_style" required>
                                                    <option value="CS">CS</option>
                                                    <option value="EE">EE</option>
                                                    <option value="SE">SE</option>
                                                    <option value="SAH">SAH</option>
                                                    <option value="SM">SM</option>
                                                    <option value="CE">CE</option>
                                                    <option value="VAs">VAs</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Designation</label>

                                                <select name="Desg_teacher" class="form-control text-gray input_style" required>
                                                    <option value="Director">Director</option>
                                                    <option value="Head of Department">Head of Department</option>
                                                    <option value="Professor">Professor</option>
                                                    <option value="Assistant Professor">Assistant Professor</option>
                                                    <option value="Lab Instructor">Lab Instructor</option>
                                                    <option value="Career Counsellor">Career Counsellor</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Joining Date</label>
                                                <input type="date" name="Reg_teacher" class="form-control text-gray input_style" required>
                                            </div>
                                        </div>

                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="email" name="Email_teacher" class="form-control input_style text-gray" required>
                                            </div>
                                        </div>

                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Salary</label>
                                                <input type="number" name="sal_teacher" class="form-control input_style text-gray" required>
                                            </div>
                                        </div>
                                        <div class="offset-lg-4"></div>
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Upload Profile Picture</label>
                                                <div class="custom-file">
                                                    <input type="file" name="Picture-teacher" id="Picture-teacher" class="custom-file-input input_style text-gray" required>
                                                    <label class="custom-file-label">Choose image</label>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <input type="submit" class="btn mt-4 bg-success" style="color: white;" name="Submit-teacher" value="Register" />
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <!-- End Add Teacher -->



            <!-- Add Course -->

            <div id="add-course" class="tab-pane fade">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card card_style">
                            <div class="card-header card_heading">

                                <div class="title">
                                    <h5 class="display-5 text-gray text-center pt-3">Add Courses</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="subheading">Course Information</h6>
                                <form method="post" action="admin.php" id="c-add">
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-4 ">
                                            <div class="form-group">
                                                <label>Course ID</label>
                                                <input type="text" name="ID_course" class="form-control input_style text-gray" id="check_CID" maxlength="10" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <div class="form-group">
                                                <label> Course Name </label>
                                                <input type="text" name="Name_course" class="form-control input_style text-gray" id="check_CNAME" maxlength="48" required>
                                            </div>
                                        </div>
                                        <div class="offset-4"></div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label> Semester </label>
                                                <select name="semester_course" class="form-control input_style text-gray" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert add_course_msg ">
                                    </div>
                                    <input type="submit" class="btn  mt-4 bg-success " style="color: white;" id="add_course" name="Submit-course" value="Register" />
                                </form>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
            <!--End Add Course -->

            <!---------------------------------Student Modals (Admin Side)--------------------------------------------->


            <!-- new added Studens view modal-->

            <div class="modal fade bd-example-modal-lg" id="Student_view_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="ModalLabel">Student Details</h5>

                        </div>
                        <div class="modal-body">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img id="Student_image" src="" alt="..." width="130" height="130" class=" rounded-circle">

                                    </div>
                                    <div class="col-md-8 mr--2">
                                        <div class="same_line">
                                            <h6>ROLL-NO: </h6>
                                            <p class="student_id_view"></p>
                                        </div>

                                        <hr>
                                        <div class="same_line">
                                            <h6>Name: </h6>
                                            <p class="student_name_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Father Name: </h6>
                                            <p class="student_father_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>DOB: </h6>
                                            <p class="student_dob_view"></p>
                                        </div>
                                        <hr>

                                    </div>
                                </div>

                                <div class="row mt-2">

                                    <div class="col-md-6 ">
                                        <div class="same_line">
                                            <h6>Blood Group: </h6>
                                            <p class="student_bg_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>CNIC: </h6>
                                            <p class="student_cnic_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Gender: </h6>
                                            <p class="student_gender_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Contact: </h6>
                                            <p class="student_contact_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Batch: </h6>
                                            <p class="student_batch_view"></p>
                                        </div>
                                        <hr>

                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="same_line">
                                            <h6>Semester: </h6>
                                            <p class="student_sem_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Department: </h6>
                                            <p class="student_dept_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Degree: </h6>
                                            <p class="student_deg_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>E-mail: </h6>
                                            <p class="student_mail_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Registration: </h6>
                                            <p class="student_reg_view"></p>
                                        </div>
                                        <hr>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- new added Student Edit modal-->

            <div class="modal fade bd-example-modal-lg" id="Student_edit_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="ModalLabel">Edit Student Details</h5>



                        </div>
                        <div class="modal-body">

                            <div class="container-fluid">

                                <form method="post" action="admin.php" id="s-edit" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" name="id-student-edit" id="student_id_edit" class="form-control text-gray input_style" readonly>
                                    </div>
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name-student-edit" id="student_name_edit" class="form-control text-gray input_style" maxlength="15" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Father Name</label>
                                                <input type="text" name="father-student-edit" id="student_father_edit" class="form-control text-gray input_style" maxlength="15" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="date" name="DOB-student-edit" id="student_dob_edit" class="form-control text-gray" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Blood Group</label>
                                                <select name="BloodGroup-student-edit" id="student_bg_edit" class="form-control text-gray input_style" required>
                                                    <option value="A+">A+</option>
                                                    <option value="B+">B+</option>
                                                    <option value="O+">O+</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="B-">B-</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class=" col-lg-3">
                                            <div class="form-group">
                                                <label>CNIC</label>
                                                <input type="text" name="CNIC-student-edit" id="student_cnic_edit" class="form-control text-gray input_style" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" max-length="13" pattern="[1-9]{2}[0-9]{3}-[0-9]{7}-[1-9]{1}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="gender-student-edit" form="s-edit" id="student_gender_edit" class="form-control text-gray input_style" required>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="text" name="Contact-student-edit" id="student_contact_edit" class="form-control text-gray input_style" data-inputmask="'mask': '0399-9999999'" type="number" placeholder="03XX-XXXXXXX" pattern="[0-3]{2}[0-9]{2}-[0-9]{7}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Professional Information -->


                                    <h4 class="display-5 text-black-50 ">Professional Information</h4>
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-3">
                                            <div class="form-group">
                                                <label>Batch</label>
                                                <input type="text" name="Batch-student-edit" id="student_batch_edit" class="form-control text-gray input_style" readonly>
                                            </div>
                                        </div>
                                        <div class=" col-lg-3">
                                            <div class="form-group">
                                                <label>Semester</label>

                                                <select name="Semester-student-edit" id="student_sem_edit" class="form-control text-gray input_style" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Department</label>

                                                <select name="Dept-student-edit" id="student_dept_edit" class="form-control text-gray input_style" required>
                                                    <option value="Computer Science">Computer Science</option>
                                                    <option value="Electrical Engineering">Electrical Engineering</option>
                                                    <option value="Software Engineering">Software Engineering</option>
                                                    <option value="Sciences and Humanities">Sciences and Humanities</option>
                                                    <option value="School Of Management">School Of Management</option>
                                                    <option value="Civil Engineering">Civil Engineering</option>
                                                    <option value="Visual Arts">Visual Arts</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Degree</label>
                                                <select name="Degree-student-edit" form="s-edit" id="student_deg_edit" class="form-control text-gray input_style" required>
                                                    <option value="BS-CS">BS-CS</option>
                                                    <option value="BS-SE">BS-SE</option>
                                                    <option value="BBA">BBA</option>
                                                    <option value="BS-EE">BS-EE</option>
                                                    <option value="BS-CE">BS-CE</option>
                                                    <option value="B.V.A.">B.V.A.</option>
                                                    <option value="MS-CS">MS-CS</option>
                                                    <option value="MS-SE">MS-SE</option>
                                                    <option value="MBA">MBA</option>
                                                    <option value="MS-EE">MS-EE</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class=" col-lg-6">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="email" name="Email-student-edit" id="student_mail_edit" class="form-control text-gray input_style" required>
                                            </div>
                                        </div>


                                    </div>
                                    <input type="submit" class="btn mt-4 bg-success" style="color: white;" name="edit-student" value="Update" />
                                </form>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- new added student delete modal-->

            <div class="modal fade bd-example-modal-lg" id="Student_delete_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="ModalLabel" style="color: white;">Delete Students Details</h5>

                        </div>
                        <form method="POST" action="admin.php" id="s-del">
                            <div class="modal-body">
                                <h6 class="subheading">Are you sure, you want to delete this data?</h6>
                                <input type="hidden" name="id-student-del" id="student_id_del" class="form-control text-gray">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger" name="model_del_student">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <!----------------------------------------- Teachers modals (admin side)---------------------->


            <!-- new added teachers view modal-->

            <div class="modal fade bd-example-modal-lg" id="teacher_view_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="ModalLabel">Teacher Details</h5>

                        </div>
                        <div class="modal-body">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img id="teacher_image" src="" alt="..." width="130" height="130" class=" rounded-circle">

                                    </div>
                                    <div class="col-md-8 mr--2">
                                        <div class="same_line">
                                            <h6>Teacher-ID: </h6>
                                            <p class="teacher_id_view"></p>
                                        </div>

                                        <hr>
                                        <div class="same_line">
                                            <h6>Name: </h6>
                                            <p class="teacher_name_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Father Name: </h6>
                                            <p class="teacher_father_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>DOB: </h6>
                                            <p class="teacher_dob_view"></p>
                                        </div>
                                        <hr>

                                    </div>
                                </div>

                                <div class="row mt-2">

                                    <div class="col-md-6 ">
                                        <div class="same_line">
                                            <h6>Blood Group: </h6>
                                            <p class="teacher_bg_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>CNIC: </h6>
                                            <p class="teacher_cnic_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Gender: </h6>
                                            <p class="teacher_gender_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Contact: </h6>
                                            <p class="teacher_contact_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Department: </h6>
                                            <p class="teacher_department_view"></p>
                                        </div>
                                        <hr>

                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="same_line">
                                            <h6>Designation: </h6>
                                            <p class="teacher_designation_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Salary: Rs.</h6>
                                            <p class="teacher_salary_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>E-mail: </h6>
                                            <p class="teacher_mail_view"></p>
                                        </div>
                                        <hr>
                                        <div class="same_line">
                                            <h6>Registration: </h6>
                                            <p class="teacher_reg_view"></p>
                                        </div>
                                        <hr>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- new added teacher Edit modal-->

            <div class="modal fade bd-example-modal-lg" id="teacher_edit_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="ModalLabel">Edit Teacher Details</h5>

                        </div>
                        <div class="modal-body">

                            <div class="container-fluid">

                                <form method="post" action="admin.php" id="t-edit" enctype="multipart/form-data">
                                   
                                            <input type="text" name="id-teacher-edit" id="teacher_id_edit" class="form-control text-gray input_style" readonly>
                                       
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name-teacher-edit" id="teacher_name_edit" class="form-control text-gray input_style" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Father Name</label>
                                                <input type="text" name="father-teacher-edit" id="teacher_father_edit" class="form-control text-gray input_style" maxlength="15" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="date" name="DOB-teacher-edit" id="teacher_dob_edit" class="form-control text-gray input_style" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Blood Group</label>
                                                <select name="BloodGroup-teacher-edit" id="teacher_bg_edit" class="form-control text-gray input_style" required>
                                                    <option value="A+">A+</option>
                                                    <option value="B+">B+</option>
                                                    <option value="O+">O+</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="B-">B-</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class=" col-lg-3">
                                            <div class="form-group">
                                                <label>CNIC</label>
                                                <input type="text" name="CNIC-teacher-edit" id="teacher_cnic_edit" class="form-control text-gray input_style" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" max-length="13" pattern="[1-9]{2}[0-9]{3}-[0-9]{7}-[1-9]{1}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="gender-teacher-edit" form="t-edit" id="teacher_gender_edit" class="form-control input_style text-gray" required>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="text" name="Contact-teacher-edit" id="teacher_contact_edit" class="form-control text-gray input_style" data-inputmask="'mask': '0399-9999999'" type="number" placeholder="03XX-XXXXXXX" pattern="[0-3]{2}[0-9]{2}-[0-9]{7}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Professional Information -->

                                    <h4 class="display-5 text-black-50 ">Professional Information</h4>
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-3">
                                            <div class="form-group">
                                                <label>Salary</label>
                                                <input type="text" name="salary-teacher-edit" id="teacher_salary_edit" class="form-control text-gray input_style" required>
                                            </div>
                                        </div>
                                        <div class=" col-lg-3">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <select name="Designation-teacher-edit" id="teacher_designation_edit" class="form-control text-gray input_style" required>
                                                    <option value="Director">Director</option>
                                                    <option value="Head of Department">Head of Department</option>
                                                    <option value="Professor">Professor</option>
                                                    <option value="Assistant Professor">Assistant Professor</option>
                                                    <option value="Lab Instructor">Lab Instructor</option>
                                                    <option value="Career Counsellor">Career Counsellor</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Department</label>

                                                <select name="Dept-teacher-edit" id="teacher_department_edit" class="form-control text-gray input_style" required>
                                                    <option value="CS">CS</option>
                                                    <option value="EE">EE</option>
                                                    <option value="SE">SE</option>
                                                    <option value="SAH">SAH</option>
                                                    <option value="SM">SM</option>
                                                    <option value="CE">CE</option>
                                                    <option value="VAs">VAs</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class=" col-lg-6">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="email" name="Email-teacher-edit" id="teacher_mail_edit" class="form-control text-gray input_style" required>
                                            </div>
                                        </div>


                                    </div>
                                    <input type="submit" class="btn mt-4 bg-success" style="color: white;" name="edit-teacher" value="Update" />
                                </form>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- new added teacher delete modal-->

            <div class="modal fade bd-example-modal-lg" id="teacher_delete_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="ModalLabel" style="color: white;">Delete Teacher Details</h5>

                        </div>
                        <form method="POST" action="admin.php" id="s-del">
                            <div class="modal-body">
                                <h5 class="subheading">Are you sure, you want to delete this data?</h5>
                                <input type="hidden" name="id-teacher-del" id="teacher_id_del" class="form-control text-gray">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger" name="model_del_teacher">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- new added course edit modal-->

            <div class="modal fade bd-example-modal-lg" id="course_edit_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="ModalLabel">Edit Course Details</h5>

                        </div>
                        <div class="modal-body">

                            <div class="container-fluid">

                                <form method="post" action="admin.php" id="c-edit" enctype="multipart/form-data">
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Course ID</label>
                                                <input type="text" name="id_course_edit" id="course_id_edit" class="form-control input_style text-gray" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Course Name</label>
                                                <input type="text" name="name_course_edit" id="course_name_edit" class="form-control input_style text-gray" maxlength="50" required>
                                            </div>
                                        </div>
                                        <div class="offset-4"></div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label> Semester</label>
                                                <select name="sem_course_edit" id="course_sem_edit" class="form-control input_style text-gray" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>



                                            </div>
                                        </div>

                                    </div>

                                    <input type="submit" class="btn mt-4 bg-success" style="color: white;" name="edit-course" value="Update" />
                                </form>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- new added course delete modal-->

            <div class="modal fade bd-example-modal-lg" id="course_delete_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="ModalLabel" style="color: white;">Delete Course Details</h5>

                        </div>
                        <form method="POST" action="admin.php" id="c-del">
                            <div class="modal-body">
                                <h5 class="subheading">Are you sure, you want to delete this data?</h5>
                                <input type="text" name="id_course_del" id="course_id_del" class="form-control input_style text-gray" readonly>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger" name="model_del_course">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- new added assign teacher to course register modal-->

            <div class="modal fade bd-example-modal-lg" id="teacher_assign_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="ModalLabel">Assign Teacher</h5>

                        </div>
                        <div class="modal-body">

                            <div class="container-fluid">

                                <form method="post" action="admin.php" id="a-register" enctype="multipart/form-data">
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Course ID</label>

                                                <select name="id_course_assign" id="course_id_assign" class="form-control input_style text-gray" required>

                                                    <?php foreach ($c_info as $I => $data) {

                                                    ?> <option value="<?= $data['ID'] ?>"><?= $data['ID'] ?></option>

                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Teacher ID</label>
                                                <select name="id_teacher_assign" id="teacher_id_assign" class="form-control input_style text-gray" required>

                                                    <?php foreach ($t_info as $I => $data) {

                                                    ?> <option value="<?= $data['ID'] ?>"><?= $data['ID'] ?></option>

                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="offset-4"></div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Section</label>
                                                <select name="sec_assign" id="assign_sec" class="form-control input_style text-gray" required>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                    <option value="E">E</option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="alert assign_course_msg">

                                    </div>


                                    <input id="assign_teacher" type="submit" class="btn mt-4 bg-success" style="color: white;" name="assign-teacher" value="Assign" />
                                </form>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" id="dismiss_success" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- new added assign course edit modal-->

            <div class="modal fade bd-example-modal-lg" id="assign_edit_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="ModalLabel">Update Assignment</h5>

                        </div>
                        <div class="modal-body">

                            <div class="container-fluid">

                                <form method="post" action="admin.php" id="a-edit" enctype="multipart/form-data">
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Course ID</label>

                                                <input name="id_course_assign_edit" id="course_id_assign_edit" class="form-control input_style text-gray" readonly>


                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Teacher ID</label>
                                                <select name="id_teacher_assign_edit" id="teacher_id_assign_edit" class="form-control input_style text-gray" required>

                                                    <?php foreach ($t_info as $I => $data) {

                                                    ?> <option value="<?= $data['ID'] ?>"><?= $data['ID'] ?></option>

                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="offset-4"></div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Section</label>
                                                <select name="sec_assign_edit" id="assign_sec_edit" class="form-control  input_style text-gray" required>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                    <option value="E">E</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="alert edit_course_msg">

                                    </div>
                                    <input type="submit" class="btn mt-4 bg-success" style="color: white;" id="assign_teacher_edit" name="assign_teacher_edit" value="Update" />
                                </form>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- new added course-teacher delete modal-->

            <div class="modal fade bd-example-modal-lg" id="course_teacher_delete_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="ModalLabel" style="color: white;">Delete Assigned Teacher</h5>
                        </div>
                        <form method="POST" action="admin.php" id="ct-del">
                            <div class="modal-body">
                                <h5 class="subheading">Are you sure, you want to delete this data?</h5>
                                <input type="text" name="id_course_teacher_del" id="course_teacher_id_del" class="form-control input_style text-gray" readonly>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger" id="model_del_course_teacher" name="model_del_course_teacher">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ----------------------Table appears when user click on registered students tab----------------------------------------- -->
            <!-- Registered students table -->

            <div id="view-student" class="tab-pane fade">

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card card_style">

                            <div class="card-header card_heading">

                                <div class="row">
                                    <div class="col-lg-3">
                                        <h5 class="display-5 text-gray pt-4 ml-4">Registered Students</h5>
                                    </div>
                                    <div class="col-lg-9">
                                        <form class="form-inline active-cyan-4 " style="padding-top: 20px;">
                                            <input class="form-control form-control-sm mr-3 w-100" type="text" placeholder="Quick Search" aria-label="Search" id="search_value_students">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="message-show">
                                </div>
                                <div class="table-responsive-lg">
                                    <div class="scroll_table">

                                        <table class="table  text-center table-hover ">
                                            <thead class="thead-light ">
                                                <tr>
                                                    <th>ROLL-NO</th>
                                                    <th>Name</th>
                                                    <th>Batch</th>
                                                    <th>Semester</th>
                                                    <th>Degree</th>
                                                    <th>Registration</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="studentdata" id="student_table">
                                                <?php foreach ($s_info as $I => $data) {

                                                ?>
                                                    <tr>
                                                        <td class="stud_id"><?= $data['ID'] ?></td>
                                                        <td><?= $data['Name'] ?></td>
                                                        <td><?= $data['Batch'] ?></td>
                                                        <td><?= $data['Semester'] ?></td>
                                                        <td><?= $data['Degree'] ?></td>
                                                        <td><?= $data['Registration'] ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-dark student_view_btn modal_buttons">View</a>

                                                            <a href="#" class="btn btn-info student_edit_btn modal_buttons">Edit</a>
                                                            <a href="#" class="btn btn-danger student_delete_btn modal_buttons">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- ----------------------Table appears when user click on records teachers tab----------------------------------------- -->

            <div id="view-teacher" class="tab-pane fade">

                <!-- Registered teacher table -->


                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card card_style">

                            <div class="card-header card_heading">

                                <div class="row">
                                    <div class="col-lg-3">
                                        <h5 class="display-5 text-gray pt-4 ml-4">Registered Teachers</h5>
                                    </div>
                                    <div class="col-lg-9">
                                        <form class="form-inline active-cyan-4" style="padding-top: 20px;">
                                            <input class="form-control form-control-sm mr-3 w-100" type="text" placeholder="Quick Search" aria-label="Search" id="search_value_teachers">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="message-show">

                                </div>
                                <div class="table-responsive-lg">
                                    <div class="scroll_table">
                                        <table class="table  text-center table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Teacher-ID</th>
                                                    <th>Name</th>
                                                    <th>Department</th>
                                                    <th>Designation</th>
                                                    <th>Registration</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="teacherdata" id="teacher_table">
                                                <?php foreach ($t_info as $I => $data) {

                                                ?>
                                                    <tr>
                                                        <td class="teacher_id "><?= $data['ID'] ?></td>
                                                        <td><?= $data['Name'] ?></td>
                                                        <td><?= $data['Department'] ?></td>
                                                        <td><?= $data['Designation'] ?></td>
                                                        <td><?= $data['Registration'] ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-dark teacher_view_btn modal_buttons ">View</a>
                                                            <a href="#" class="btn btn-info teacher_edit_btn modal_buttons">Edit</a>
                                                            <a href="#" class="btn btn-danger teacher_delete_btn modal_buttons">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>





            <!-- ----------------------Table appears when user click on registered courses tab----------------------------------------- -->

            <div id="view-course" class="tab-pane fade">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card card_style">

                            <div class="card-header card_heading">

                                <div class="row">
                                    <div class="col-lg-3">
                                        <h5 class="display-5 text-gray pt-4 ml-4">Registered Courses</h5>
                                    </div>
                                    <div class="col-lg-9">
                                        <form class="form-inline active-cyan-4" style="padding-top: 20px;">
                                            <input class="form-control form-control-sm mr-3 w-100" type="text" placeholder="Quick Search" aria-label="Search" id="search_value_course">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="message-show">

                                </div>
                                <div class="table-responsive-lg">
                                    <div class="scroll_table">
                                        <table class="table text-center table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Course-ID</th>
                                                    <th>Course Name</th>
                                                    <th>Semester</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="coursedata" id="course_table">
                                                <?php foreach ($c_info as $I => $data) {

                                                ?>
                                                    <tr>
                                                        <td class="course_id"><?= $data['ID'] ?></td>
                                                        <td><?= $data['Name'] ?></td>
                                                        <td><?= $data['Semester'] ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-info course_edit_btn modal_buttons">Edit</a>
                                                            <a href="#" class="btn btn-danger course_delete_btn modal_buttons">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ----------------------Table appears when user click on assign teachers tab----------------------------------------- -->

            <div id="assign-course" class="tab-pane fade">

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card card_style">

                            <div class="card-header card_heading">

                                <div class="row">
                                    <div class="col-lg-3">
                                        <h5 class="display-5 text-gray pt-4 ml-4">Assigned Teachers</h5>
                                    </div>
                                    <div class="col-lg-7">
                                        <form class="form-inline active-cyan-4" style="padding-top: 20px;">
                                            <input class="form-control form-control-sm mr-3 w-100" type="text" placeholder="Quick Search" aria-label="Search" id="search_assigned_course">
                                        </form>
                                    </div>


                                    <div class="col-lg-2" style="padding-top: 17px;">

                                        <a href="#" class="btn btn-success course_assign_btn">+ Assign</a>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="message-show">
                                </div>
                                <div class="table-responsive-lg">
                                    <div class="scroll_table">
                                        <table class="table text-center table-hover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="course-assign-id">Course-ID</th>
                                                    <th>Teacher ID</th>
                                                    <th>Section</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="assigned_teacher_data" id="assigned_table">

                                                <?php foreach ($ct_info as $I => $data) {

                                                ?>
                                                    <tr>
                                                        <td class="course_teacher_id"><?= $data['CID'] ?></td>
                                                        <td class="course_teacherid"><?= $data['TID'] ?></td>
                                                        <td class="course_teacher_sec"><?= $data['section'] ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-info assign_edit_btn modal_buttons">Edit</a>
                                                            <a href="#" class="btn btn-danger assign_delete_btn modal_buttons">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="change_password" class="tab-pane fade active">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card card_style">
                            <div class="card-header card_heading">

                                <div class="title">
                                    <h5 class="display-5 text-gray text-center pt-3">Accessibility</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="subheading">Change Password</h6>
                                <form method="post" action="admin.php" id="c-change">
                                    <div class="row text-dark pt-3">
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>User-ID</label>
                                                <input type="text" name="pass_id" class="form-control input_style text-gray" id="id_pass" value=<?= $temp ?> readonly>
                                            </div>
                                        </div>
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input type="password" name="old_pass" class="form-control input_style text-gray" id="check_pass_old" required>
                                            </div>
                                        </div>
                                        <div class="offset-md-4"></div>
                                        <div class=" col-lg-4">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" name="new_pass" class="form-control input_style text-gray" id="check_pass_new" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="pass_error"></div>
                                    <input type="button" class="btn  mt-4 bg-danger pass_change" style="color: white;" id="pass_change" name="Submit-pass" value="Update" />
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>


</body>

</html>