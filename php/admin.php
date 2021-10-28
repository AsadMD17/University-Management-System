<?php

include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

class add
{

  public $conn;
  function __construct($dbh)
  {
    $this->conn = $dbh;
  }


  public $student_count;

  function get_student_count($batch)
  {
    $query = " select count(Name) AS c from student_information where Batch = '$batch' ";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['c'] + 1;
  }

  function get_teacher_count()
  {
    $query = " select count(Name) AS c from teacher_information";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['c'] + 1;
  }

  function upload_image($img)
  {
    $target_dir = "../GRAPHICS/user_pics/";
    $target_file = $target_dir . basename($_FILES["$img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($_FILES["$img"]["size"] > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    if ($uploadOk == 1) {
      move_uploaded_file($_FILES["$img"]["tmp_name"], $target_file);
      return $target_file;
    }
  }
  function add_student()
  {

    $u_name = $_POST['name-student'];
    $u_father = $_POST['father-student'];
    $u_DOB = $_POST['DOB-student'];
    $u_BloodGroup = $_POST['BloodGroup-student'];
    $u_CNIC = $_POST['CNIC-student'];
    $u_Gender = $_POST['gender-student'];
    $u_contact = $_POST['Contact-student'];
    $u_Batch = $_POST['Batch-student'];
    $u_semester = $_POST['Semester-student'];
    $u_Dept = $_POST['Dept-student'];
    $u_Degree  = $_POST['Degree-student'];
    $u_Email = $_POST['Email-student'];
    $u_reg = date("Y/m/d");
    $u_psd = rand(10000, 20000);

    $u_count =    $this->get_student_count($u_Batch);
    $u_roll = "$u_Batch" . "F-" . "$u_count";

    if ($u_path = $this->upload_image('Picture-student')) {

      $query = "Insert into student_information values ( '$u_roll', '$u_name' , '$u_father', '$u_DOB' , '$u_BloodGroup', '$u_CNIC', '$u_Gender','$u_contact', '$u_Batch' ,'$u_semester', '$u_Dept', '$u_Degree','$u_Email','$u_reg','$u_path') ";
      $stmt = $this->conn->prepare($query);
      $result = $stmt->execute();
      echo  $query;
      $query = "Insert into student_credentials values ( '$u_roll', '$u_psd ') ";
      $stmt = $this->conn->prepare($query);
      $result = $stmt->execute();
      echo "<META http-equiv=\"refresh\" content=\"0;URL=admin-dashboard.php\">";
    } else {
      echo "error";
    }
  }
  function get_picture($id, $table1)
  {
    $query = "SELECT Picture AS P,Name AS N FROM $table1 where ID = '$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
  }


  function add_teacher()
  {

    $u_name = $_POST['name_teacher'];
    $u_father = $_POST['Father_teacher'];
    $u_DOB = $_POST['DOB_teacher'];
    $u_BloodGroup = $_POST['Blood_teacher'];
    $u_CNIC = $_POST['CNIC_teacher'];
    $u_Gender = $_POST['Gender_teacher'];
    $u_contact = $_POST['Contact_teacher'];
    $u_Dept = $_POST['Dept_teacher'];
    $u_Designaion = $_POST['Desg_teacher'];
    $u_reg = $_POST['Reg_teacher'];
    $u_Email = $_POST['Email_teacher'];
    $u_sal  = $_POST['sal_teacher'];

    $u_count =    $this->get_teacher_count();
    $u_ID = "$u_Dept" . "-" . "$u_count";

    if ($u_path = $this->upload_image('Picture-teacher')) {
      $query = "Insert into teacher_information values ( '$u_name', '$u_father' , '$u_DOB' , '$u_BloodGroup', '$u_CNIC', '$u_Gender','$u_contact' , '$u_Dept', '$u_Designaion','$u_reg','$u_Email','$u_sal','$u_path','$u_ID') ";
      $stmt = $this->conn->prepare($query);
      $result = $stmt->execute();
      $u_psd = rand(10000, 27802);


      $query = "Insert into teacher_credentials values ( '$u_ID ', '$u_psd ') ";
      $stmt = $this->conn->prepare($query);
      $result = $stmt->execute();
      echo "<META http-equiv=\"refresh\" content=\"0;URL=admin-dashboard.php\">";
    } else {
      echo "error";
    }
  }

  function add_course()
  {

    $data = $_POST['course_data'];
    $form_data = [];

    foreach ($data as $R) {
      array_push($form_data, $R['value']);
    }
    $u_ID = $form_data[0];
    $u_name =  $form_data[1];
    $c_semester = $form_data[2];

    $obj = new get($this->conn);


    if ($obj->get_course_details($u_ID)) {
      echo 0;
    } else {
      $query = "Insert into course_information values ( '$u_ID', '$u_name','$c_semester')";
      $stmt = $this->conn->prepare($query);
      $result = $stmt->execute();
      echo 1;
    }
  }
  function add_course_teacher()
  {

    $u_cID = $_POST['course_teacher_id'];
    $u_tID = $_POST['assign_teacher_id'];
    $c_sec = $_POST['course_sec_id'];
    $query = "Select CID FROM course_teacher WHERE CID='$u_cID' AND section= '$c_sec'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetchAll();
    $count = 0;
    foreach ($row as $I => $data) {

      if ($data['CID']) {
        $count++;
      }
    }

    if ($count > 0) {
      echo 0;
    } else {
      echo 1;
      $query = "Insert into course_teacher values( '$u_cID', '$u_tID','$c_sec')";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
    }
  }
}
// new added
class get
{

  function __construct($dbh)
  {
    $this->conn = $dbh;
  }

  function get_students()
  {
    $query = " select * from student_information";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetchAll();
    return $row;
  }
  function get_student_details($id)
  {
    $query = " select * from student_information where ID ='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetchAll();
    return $row;
  }

  function get_teacher()
  {
    $query = " select * from teacher_information";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetchAll();
    return $row;
  }

  function get_teacher_details($id)
  {
    $query = " select * from teacher_information where ID ='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetchAll();
    return $row;
  }

  function get_course_details($cid)
  {
    $query = " select * from course_information where ID ='$cid'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetchAll();
    return $row;
  }
  function get_courses()
  {
    $query = " select * from course_information ";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetchAll();
    return $row;
  }
  function get_course_teacher()
  {
    $query = " select * from course_teacher";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetchAll();
    return $row;
  }
}
// new added
class edit
{

  function __construct($dbh)
  {
    $this->conn = $dbh;
  }

  function edit_student_details()
  {
    $u_id = $_POST['id-student-edit'];
    $u_name = $_POST['name-student-edit'];
    $u_father = $_POST['father-student-edit'];
    $u_DOB = $_POST['DOB-student-edit'];
    $u_BloodGroup = $_POST['BloodGroup-student-edit'];
    $u_CNIC = $_POST['CNIC-student-edit'];
    $u_Gender = $_POST['gender-student-edit'];
    $u_contact = $_POST['Contact-student-edit'];
    $u_Batch = $_POST['Batch-student-edit'];
    $u_semester = $_POST['Semester-student-edit'];
    $u_Dept = $_POST['Dept-student-edit'];
    $u_Degree  = $_POST['Degree-student-edit'];
    $u_Email = $_POST['Email-student-edit'];
    $query = "UPDATE student_information SET Name='$u_name',Father_Name='$u_father',DOB='$u_DOB',Blood_Group='$u_BloodGroup',CNIC='$u_CNIC',Gender='$u_Gender',Contact='$u_contact',Batch='$u_Batch',Semester='$u_semester',Department='$u_Dept',Degree='$u_Degree',Email='$u_Email' WHERE ID='$u_id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    echo "<META http-equiv=\"refresh\" content=\"0;URL=admin-dashboard.php\">";
  }

  function edit_teacher_details()
  {
    $u_id = $_POST['id-teacher-edit'];
    $u_name = $_POST['name-teacher-edit'];
    $u_father = $_POST['father-teacher-edit'];
    $u_DOB = $_POST['DOB-teacher-edit'];
    $u_BloodGroup = $_POST['BloodGroup-teacher-edit'];
    $u_CNIC = $_POST['CNIC-teacher-edit'];
    $u_Gender = $_POST['gender-teacher-edit'];
    $u_contact = $_POST['Contact-teacher-edit'];
    $u_Salary = $_POST['salary-teacher-edit'];
    $u_Dept = $_POST['Dept-teacher-edit'];
    $u_Desig = $_POST['Designation-teacher-edit'];
    $u_Email = $_POST['Email-teacher-edit'];
    $query = "UPDATE teacher_information SET Name='$u_name',Father_Name='$u_father',DOB='$u_DOB',Blood_Group='$u_BloodGroup',CNIC='$u_CNIC',Gender='$u_Gender',Contact='$u_contact',Department='$u_Dept',Designation='$u_Desig',Email='$u_Email',Salary='$u_Salary' WHERE ID='$u_id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    echo "<META http-equiv=\"refresh\" content=\"0;URL=admin-dashboard.php\">";
  }

  function edit_course_details()
  {
    $u_id = $_POST['id_course_edit'];
    $u_name = $_POST['name_course_edit'];
    $u_sem = $_POST['sem_course_edit'];

    $query = "UPDATE course_information SET Name='$u_name', Semester='$u_sem' WHERE ID='$u_id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();

    echo "<META http-equiv=\"refresh\" content=\"0;URL=admin-dashboard.php\">";
  }
  function edit_course_teacher()
  {
    $old_teacher = $_POST['old_teacher'];
    $old_sec = $_POST['old_sec'];
    $u_cID = $_POST['course_teacher_id_edit'];
    $u_tID = $_POST['assign_teacher_id_edit'];
    $c_sec = $_POST['course_sec_id_edit'];
    $count = 0;

    $query = "Select CID FROM course_teacher WHERE CID='$u_cID' AND section= '$c_sec'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetchAll();
    foreach ($row as $I => $data) {

      if ($data['CID']) {
        $count++;
      }
    }
    if ($count > 0) {
      if ($old_sec == $c_sec) {
        if ($old_teacher != $u_tID) {
          $count = 0;
        }
      }
    }


    if ($count > 0) {
      echo 0;
    } else {

      $query = "UPDATE course_teacher SET TID='$u_tID',section='$c_sec' where CID ='$u_cID' AND TID='$old_teacher' AND section='$old_sec'";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      echo 1;
    }
  }

  function edit_admin_password()
  {
    $u_id = $_POST['user_pass_id'];
    $u_old = $_POST['user_old_pass'];
    $u_new = $_POST['user_new_pass'];
    $count = 0;

    $query = "Select ID FROM admin_credentials WHERE Password='$u_old' AND ID='$u_id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetchAll();
    foreach ($row as $I => $data) {

      if ($data['ID']) {
        $count++;
      }
    }
    if ($count > 0) {
      $query = "UPDATE admin_credentials SET Password='$u_new' WHERE ID='$u_id'";
      $stmt = $this->conn->prepare($query);
      $result = $stmt->execute();
      echo 1;
    } else {
      echo 0;
    }
  }
}

// new added
class del
{

  function __construct($dbh)
  {
    $this->conn = $dbh;
  }

  function del_student()
  {

    $id = $_POST['id-student-del'];
    $query = "DELETE FROM student_information WHERE Id='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $query = "DELETE FROM student_credentials WHERE Id='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $query = "DELETE FROM attendance WHERE SID='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $query = "DELETE FROM course_registration WHERE SID='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    echo "<META http-equiv=\"refresh\" content=\"0;URL=admin-dashboard.php\">";
  }
  function del_teacher()
  {

    $id = $_POST['id-teacher-del'];
    $query = "DELETE FROM teacher_information WHERE Id='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $query = "DELETE FROM teacher_credentials WHERE Id='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $query = "DELETE FROM course_teacher WHERE TID='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    echo "<META http-equiv=\"refresh\" content=\"0;URL=admin-dashboard.php\">";
  }

  function del_course()
  {

    $id = $_POST['id_course_del'];
    $query = "DELETE FROM course_information WHERE ID='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $query = "DELETE FROM course_registration WHERE CID ='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $query = "DELETE FROM course_teacher WHERE CID ='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $query = "DELETE FROM attendance WHERE CID ='$id'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    echo "<META http-equiv=\"refresh\" content=\"0;URL=admin-dashboard.php\">";
  }

  function del_course_teacher()
  {
    $secid_del = $_POST['del_old_sec'];
    $tid_del = $_POST['del_old_teacher'];
    $cid_del = $_POST['course_old_id'];
    $query = "DELETE FROM course_teacher WHERE CID ='$cid_del' AND TID ='$tid_del' AND section='$secid_del'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
  }
}
//------------------------------------Student--------------------------------------------------//
// For teacher submission
if (isset($_POST['Submit-student'])) {

  $obj = new add($conn);
  $obj->add_student();
}
// new added (edit Student details)
if (isset($_POST['edit-student'])) {

  $obj = new edit($conn);
  $obj->edit_student_details();
}
// new added (delete Student details)
if (isset($_POST['model_del_student'])) {
  $obj = new del($conn);
  $obj->del_student();
}
// new added (display Student details)
if (isset($_POST['student_checking_view'])) {
  $stud_id = $_POST['stud_id'];
  $student_info = new get($conn);
  $info = $student_info->get_student_details($stud_id);

  $result_array = [];
  foreach ($info as $data) {
    array_push($result_array,  $data);
  }
  header('Content-type: application/json');
  echo json_encode($result_array);
}

// new added (autofill edit Student details)
if (isset($_POST['student_checking_edit'])) {
  $stud_id = $_POST['stud_id'];
  $student_info = new get($conn);
  $info = $student_info->get_student_details($stud_id);

  $result_array = [];
  foreach ($info as $data) {
    array_push($result_array,  $data);
  }
  header('Content-type: application/json');
  echo json_encode($result_array);
}


//------------------------------------Teacher--------------------------------------------------//

// For teacher submission
if (isset($_POST['Submit-teacher'])) {
  $obj = new add($conn);
  $obj->add_teacher();
}
// new added (edit teacher details)
if (isset($_POST['edit-teacher'])) {

  $obj = new edit($conn);
  $obj->edit_teacher_details();
}
// new added (delete teacher details)
if (isset($_POST['model_del_teacher'])) {
  $obj = new del($conn);
  $obj->del_teacher();
}



// new added (display teacher details)
if (isset($_POST['teacher_checking_view'])) {
  $teacher_id = $_POST['teacher_id'];
  $teacher_info = new get($conn);
  $info = $teacher_info->get_teacher_details($teacher_id);

  $result_array = [];
  foreach ($info as $data) {
    array_push($result_array,  $data);
  }
  header('Content-type: application/json');
  echo json_encode($result_array);
}

// new added (autofill edit teacher details)
if (isset($_POST['teacher_checking_edit'])) {
  $teacher_id = $_POST['teacher_id'];
  $teacher_info = new get($conn);
  $info = $teacher_info->get_teacher_details($teacher_id);

  $result_array = [];
  foreach ($info as $data) {
    array_push($result_array,  $data);
  }
  header('Content-type: application/json');
  echo json_encode($result_array);
}
//------------------------------------Course--------------------------------------------------//

// For course submission
if (isset($_POST['add_course_submit'])) {
  $obj = new add($conn);
  $obj->add_course();
}
// For course  auto-fill from
if (isset($_POST['course_checking_edit'])) {
  $course_id = $_POST['course_id'];
  $course_info = new get($conn);
  $info = $course_info->get_course_details($course_id);

  $result_array = [];
  foreach ($info as $data) {
    array_push($result_array,  $data);
  }
  header('Content-type: application/json');
  echo json_encode($result_array);
}
// For course  edit from
if (isset($_POST['edit-course'])) {

  $obj = new edit($conn);
  $obj->edit_course_details();
}

// For course delete from
if (isset($_POST['model_del_course'])) {
  $obj = new del($conn);
  $obj->del_course();
}

// For assign-course-teacher 
if (isset($_POST['assign_checking_submit'])) {
  $obj = new add($conn);
  $obj->add_course_teacher();
}
// For edit course-teacher
if (isset($_POST['assign_checking_edit'])) {
  $obj = new edit($conn);
  $obj->edit_course_teacher();
}
//For delete course-teacher
if (isset($_POST['assign_checking_del'])) {
  $obj = new del($conn);
  $obj->del_course_teacher();
}
//-----------------------------Change Password----------------------------------
//For delete course-teacher
if (isset($_POST['check_pass_change'])) {

  $obj = new edit($conn);
  $obj->edit_admin_password();
}
