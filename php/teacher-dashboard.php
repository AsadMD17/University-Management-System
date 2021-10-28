<?php
include 'teacher.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['teacher_credentials'])){
    header('location: teacher-login.php');
}
$temp = $_SESSION['teacher_credentials']; 
$obj=new add($conn);
$user_data=$obj->get_picture($temp,"teacher_information");
$Pic=$user_data['P'];
$Name=$user_data['N'];

$course_obj = new mark_attendance($conn);
$courses= $course_obj->get_courses();


if(isset($_POST['logout']))
{
    session_start();
    session_destroy();
    header("Location: teacher-login.php");
    exit;
}?>


<html>

<head>
    <title>Teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <script>
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#mytab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>


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
                <img id="Profile-Pic" src="../graphics/profile.jpg" alt="..." width="70" class="photo">
            </div>
            <div class=""style="margin: auto;width:auto; text-align: center;">
               <a href="#drop-down-user" id="logout_btn" data-toggle="collapse" aria-expanded="false" class=" dropdown-toggle text-dark py-2"> User_Name </a>
               <div class="collapse" id="drop-down-user">
                 <form method="POST" action="">
                   <a href="#"> <i class="fa fa-drivers-license-o  text-gray fa-fw drop-down-content pt-2">  My Profile</i></a>
                  <a href="#"> <i class="fa fa-gear  text-gray fa-fw drop-down-content">  Change Password</i></a><hr>
                  <input type="submit" class="logout-style drop-down-content mb-2" name="logout" value="logout" />
               </form>
               </div>
            <script>
                document.getElementById('logout_btn').innerHTML = "<?PHP echo "Hello Mr, ".$Name; ?>" ;
                document.getElementById('Profile-Pic').src = "<?PHP echo $Pic; ?>";
            </script>
          
            </div>
        </div>
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-1 mb-0">Panel</p>

        <ul class="nav  flex-column bg-white mb-0" id='mytab'>
            <li class="nav-item">
                <a data-toggle="tab" href="#view-presonal" class="nav-link text-dark">
                    <i class="fa fa-search mr-3 text-primary fa-fw"></i> Personal info                        </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" id="mark-att" href="#mark-attendance" class="nav-link text-dark">
                    <i class="fa fa-user-plus mr-3 text-primary fa-fw"></i> Mark Attendance
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" href="#edit-attendance" class="nav-link text-dark">
                    <i class="fa fa-remove mr-3 text-primary fa-fw"></i> Attendance Records
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
            <div id="view-presonal" class="tab-pane fade  active">
            <h2 class="display-5 text-black-50 "> Personal info </h2>
            </div>

           <!-- Add Attendance -->
            <div id="mark-attendance" class="tab-pane fade a">
                <div id = "date-error" class="alert alert-danger " style = "visibility:hidden;"  >
                          <strong>Alert !</strong> Please select a date.
                    </div>
  
                <div>
                   <form method="POST" id="stb" >  
                     <div class="row text-dark pt-3 pb-3" id ="add-attendance-search">
                           <div class="offset-lg-1 "></div>
                              <div class="col-lg-3 ">
                               <select  id ="checkme"  name="checkme" class="form-control text-muted" required>
                                        <?php 
                                        foreach ($courses as $CR => $c) {
                                        ?>  
                                           <option value="<?=$c['CID']."_".$c['section']?>"> <?=$c['CID']."_".$c['section'] ?> </option>
                                        <?php } ?>

                                        </select>
                              </div>
                            <div class="col-lg-3">
                            <div class="form-group">
                                <input type="date" name="att-date" id="att-date" class="form-control text-muted" required>    
                        </div>
                     </div >
                        <input type="submit" id="get-students" class="btn bg-success ml-3 mb-3" style="color: white;" name="getStudent" value="Add" >        
                     </div>
                    
                       
                    </form>     

            <div class="container-fluid">
                <div class="row ">
                    <div class="offset-1"></div>
                   <div class="col-sm-8">
                    <form  method="POST" id ="save-attendance"   >
                         <div class="table-responsive-md bg-light ml-sm-5">
                             
                        <table class="table table-hover ">
                          <thead >
                                  <tr class='text-center'>
                                      <th>Roll No</th>
                                      <th>Name </th>
                                      <th>Status</th>
                                    </tr>
                            </thead>
                            <tbody id="student-rows">
                              

                               
                                        
                            </tbody>   



                           </table>    
                      </div>
                    </form>
                    </div>
                    </div>
                </div>
                 
                </div>                    
                
            </div>
                               
          
            <!-- Edit Attendance -->
            <div id="edit-attendance" class="tab-pane fade ">
            <div>
                   <form method="POST" id="edit-att" >  
                     <div class="row text-dark pt-3 pb-3" id ="add-attendance-search">
                           <div class="offset-lg-3 "></div>
                              <div class="col-lg-3 ">
                               <select  id ="checkme"  name="checkme" class="form-control text-muted" required>
                                        <?php 
                                        foreach ($courses as $CR => $c) {
                                        ?>  
                                           <option value="<?=$c['CID']."_".$c['section']?>"> <?=$c['CID']."_".$c['section'] ?> </option>
                                        <?php } ?>

                                        </select>
                              </div>
                           
                        <input type="submit" id="edit_get_attendance" class="btn bg-success ml-3 mb-3" style="color: white;" name="edit_get_attendance" value="Edit" >        
                     </div>    
                   </form>     

                   <div class="container mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">

                                <div class="card-header">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4>
                                                Registered Students
                                            </h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <form class="form-inline active-cyan-4">
                                                <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search" aria-label="Search" id="search_value_students">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="message-show">

                                    </div>
                                    <div class="table-responsive-lg">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Course ID</th>
                                                    <th>Section</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="course_attendance_data" id="get_course_attendance">
                                         
                                                 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            


            
             
            </div>


            <!-- Add Marks -->

            
        </div>


        <!-- edit attendance of a specific date model -->

        <div class="modal fade bd-example-modal-lg" id="attendance_edit_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title" id="ModalLabel">Edit Attendance</h5>

                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                      <div class="row ">
                                            <div class="offset-1"></div>
                                            <div class="col-sm-8">
                                                 <form  method="POST" id ="save-attendance"   >
                                                       <div class="table-responsive-md bg-light ml-sm-5">
                             
                                                            <table class="table table-hover ">
                                                                  <thead >
                                                                       <tr class='text-center'>
                                                                       <th>Roll No</th>
                                                                       <th>Name </th>
                                                                       <th>Status</th>
                                                                       </tr>
                                                                  </thead>
                                                                  <tbody id="edit-student-rows">
                                                                         
                                                                    
                               
                                        
                                                                 </tbody>   
                                                           </table>    
                                                    
                                                        </div>
                                                  </form>
                                            
                                      </div>
                                              
                            </div>
                                                <div class="row">
                                                    <div class="offset-7"></div>
                                                       <div class="col-2 ml-3">
                                                          <button type="button" class="btn btn-success" id="udpate_attendance" >Update</button>
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

          


            <div class="modal fade bd-example-modal-lg" id="attendance_delete_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" action="admin.php" id="s-del">
                            <div class="modal-body">
                                <h5>Are you sure, you want to delete this data?</h5>
                                <input type="hidden" name="id-student-del" id="student_id_del" class="form-control text-muted">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger" id ="model_del_attendance" name="model_del_attendance">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>













    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>      
    <script src="../js/main.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
  </body>  

</html>