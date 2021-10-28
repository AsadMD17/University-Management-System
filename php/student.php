<?php 
include 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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

  class course_registeration{
    public $sem ; 
    public $conn;
    public $ID;
 
    function __construct($dbh)
    {
         $this->conn = $dbh;
    }
 
 
   function get_semester($id)
  {
   $this->ID = $id;
   $query = "SELECT semester AS s FROM student_information where ID = '$id'";
   $stmt = $this->conn->prepare($query);
   $result = $stmt->execute();
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $this->sem = $row['s'];
 
  }
   function get_courses(){
     $query = "SELECT ID AS I,Name AS N FROM course_information where semester = '$this->sem' ";
     $stmt = $this->conn->prepare($query);
     $result = $stmt->execute();
     $row = $stmt->fetchAll();
     return $row;  
   
   }

   
   function get_sections($cid){
     $query = "SELECT section FROM course_teacher where CID = '$cid' ORDER BY `section` ASC";
     $stmt = $this->conn->prepare($query);
     $result = $stmt->execute();
     $row = $stmt->fetchAll();
  
     return $row;  
   
   }
 
   function register_course(){
 
     if(!empty($_POST['selection'])) {
       $selection = $_POST['selection'];
       foreach($_POST['selection'] as $check) {
         $course_id = $check;
         $section = $_POST[$check];
         $query = "SELECT TID  FROM course_teacher where CID = '$course_id'";
         $stmt = $this->conn->prepare($query);
         $result = $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);        
         $TID= $row['TID'];
         $SID = $_SESSION['student_credentials']; 
         $query = "SELECT Name  FROM student_information where ID = '$SID'";
         $stmt = $this->conn->prepare($query);
         $result = $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);        
         $name = $row['Name'];
 
 
         $query = "INSERT INTO  course_registration values('$course_id', '$SID' , '$section', '$TID', '$name')";
         $stmt = $this->conn->prepare($query);
         $result = $stmt->execute();       
         
       }
     }
     echo "<META http-equiv=\"refresh\" content=\"0;URL=student-dashboard.php\">";
        
 
   }
 
 
 
 }
 
 class attendance{

    public $conn;
   
    function __construct($dbh){
         $this->conn = $dbh;
    }
  
  
    function get_registerated_courses(){
      $SID = $_SESSION['student_credentials']; 
      $query = "SELECT CID FROM course_registration where SID = '$SID'";
      $stmt = $this->conn->prepare($query);
      $result = $stmt->execute();
      $row = $stmt->fetchAll();
     
      return $row; 
  
    }
  
    function get_course_attendence(){
      $SID = $_SESSION['student_credentials']; 
      $CID =  $_POST['course_id'];
      $query = "SELECT Date,Status FROM attendance where SID = '$SID' and CID = '$CID'";
      $stmt = $this->conn->prepare($query);
      $result = $stmt->execute();
      $row = $stmt->fetchAll();
      if($row){ 
        return $row;    
      }
  
  
     
    }
  
  
  }
  


  if(isset($_POST['reg-courses'])){
    $obj = new course_registeration($conn);
    $obj->register_course();
    exit(); 
  }
 



  if(isset($_POST['attendence_checking_view'])){

    $att=new attendance($conn);
    $rows= $att->get_course_attendence();    
       
    $array=[];
   
    foreach($rows as $p)
    {
      array_push( $array , $p);
    }
    header('Content-type: application/json');
    echo json_encode($array);  
  
    exit(); 
  }
  









?>