<?php   

include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

class mark_attendance{

    public $conn;
    
    function __construct($dbh){
         $this->conn = $dbh;
    }
  
    
   function get_courses()
   {
    
    $TID = $_SESSION['teacher_credentials']; 
    $query = "SELECT CID , section  FROM course_teacher where TID = '$TID'";
    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    $row = $stmt->fetchAll();
    $data_array =[];
    foreach($row as $data){
        array_push($data_array, $data);
       } 
      json_encode($data_array);
      
      return $row;
  
   }
  
function get_attendance_datewise(){

  $Course_ID = $_POST['CID'];
  $date = $_POST['date'];
  $sec = $_POST['section'];
  
  $query = "SELECT Date,SID,Status FROM attendance where CID = '$Course_ID' and Section = '$sec' and Date ='$date'";
  $stmt = $this->conn->prepare($query);
  $result = $stmt->execute();
  $row = $stmt->fetchAll();
 
  return $row;

}

function update_attendance(){

  $Course_ID = $_POST['attendance_id'];
  $date = $_POST['attendance_date'];
  $sec = $_POST['section'];
  $SIDs = $_POST['SIDs'];
  $statuses = $_POST['status'];
  for($i=0;$i<sizeof($SIDs);$i++){
  $query = "UPDATE attendance set Status = '$statuses[$i]' where SID = '$SIDs[$i]' and Date = '$date' and CID ='$Course_ID' and Section ='$sec' ";
  $stmt = $this->conn->prepare($query);
  $result = $stmt->execute();
 
   }


}
 

function delete_attendance(){
  $Course_ID = $_POST['attendance_id'];
  $date = $_POST['attendance_date'];
  $sec = $_POST['section'];

  $query = "DELETE FROM attendance  where CID = '$Course_ID' and Date = '$date' and Section ='$sec' ";
  $stmt = $this->conn->prepare($query);
  $result = $stmt->execute();
  echo "<META http-equiv=\"refresh\" content=\"0;URL=admin-dashboard.php\">";
 
}



  
   


   function get_attendance_dates(){
    $data= $_POST['data'];
    $form_data=[];

    foreach($data as $R)
    {
      array_push($form_data, $R['value']);  
    }
  $course = $form_data[0];

  $len = strlen($course);
  $Course_ID="";
  $sec="";
  for($i=0; $i<$len;$i++){
   if($course[$i] != "_"){
       $Course_ID.=$course[$i];
   }
   else{
     $sec=$course[$i+1];
     break;
   }
  }
  
  
  
  $TID = $_SESSION['teacher_credentials']; 
  
  $query = "SELECT  Date,CID,Section FROM attendance where CID = '$Course_ID' and Section = '$sec' ";
  $stmt = $this->conn->prepare($query);
  $result = $stmt->execute();
  $row = $stmt->fetchAll();


 return $row;

   }



   function get_students($CID, $sec){ 
  
     $query = "SELECT SID , Stu_name FROM course_registration where CID = '$CID' and Section = '$sec' ";
     $stmt = $this->conn->prepare($query);
     $result = $stmt->execute();
     $row = $stmt->fetchAll();
     
    
     return $row;
  }
  
  
  
  
  }
  

  
  class add{

    public $conn;
    function __construct($dbh)
       {
            $this->conn = $dbh;
       }
    
       function get_picture($id,$table1)
       {
         $query = "SELECT Picture AS P,Name AS N FROM $table1 where ID = '$id'";
         $stmt = $this->conn->prepare($query);
         $result = $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         return $row;
         
       }         
    
}





    // insert attendance
    $stud_obj = new mark_attendance($conn);

    if(isset($_REQUEST['attendance_run'])){
 
        $attendance_date = $_REQUEST['attendance_date'];
        $attendance_course = $_REQUEST['attendance_course'];
        $status = $_REQUEST['status'];
        $name = $_REQUEST['names'];
        $SID = $_REQUEST['SIDs'];

        $TID = $_SESSION['teacher_credentials']; 
      
        $len = strlen($attendance_course);
        $Course_ID="";
        $sec="";
        for($i=0; $i<$len;$i++){
         if($attendance_course[$i] != "_"){
             $Course_ID.=$attendance_course[$i];
         }
         else{
           $sec=$attendance_course[$i+1];
           break;
         }
        }
       
       for($i=0;$i<sizeof($SID);$i++){
        $query = "Insert into attendance values('$attendance_date', '$SID[$i]','$Course_ID','$sec','$status[$i]','$TID')";   
        $stmt = $conn->prepare($query);
        $result = $stmt->execute();
      }
        exit();  
      }
      
      
// get students for attendance after course selection

 if(isset($_REQUEST['att-date'])){
         
        global $stud_obj;
        if(($_REQUEST['att-date']))
        {
          $date= $_REQUEST['att-date'];
        
         $str = $_REQUEST['checkme']; 
         $len = strlen($str);
         $Course_ID="";
         $sec="";
         for($i=0; $i<$len;$i++){
          if($str[$i] != "_"){
              $Course_ID.=$str[$i];
          }
          else{
            $sec=$str[$i+1];
            break;
          }
         } 
      
      $stud_list = $stud_obj->get_students($Course_ID, $sec);
      $array=[];
      foreach($stud_list as $p)
      {
      array_push( $array , $p );
      }
       
        header('Content-type: application/json');
        echo json_encode($array);
        }
        
        exit();
}
    
/// edit attendance 
if(isset($_POST['attendence_checking_edit'])){

  global $stud_obj;

   $info=  $stud_obj->get_attendance_dates();
  
   $result_array = [];
  foreach ($info as $data) {
    array_push($result_array,  $data);
  }
  header('Content-type: application/json');
  echo json_encode($result_array);

}


 //edit attendance model


 if(isset($_POST['attendence_date_edit'])){

  global $stud_obj;

  $info=  $stud_obj->get_attendance_datewise();
   $result_array = [];
  foreach ($info as $data) {
    array_push($result_array,  $data);
  }

 header('Content-type: application/json');
 echo json_encode($result_array);
  

}

// update attendance
if(isset($_POST['attendance_update'])){

  global $stud_obj;
  $stud_obj->update_attendance();
  
}

// Delete attendance
if(isset($_POST['attendance_delete'])){
  global $stud_obj;
  $stud_obj->delete_attendance();  
}



?>