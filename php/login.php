<?php 

include 'db.php';
class login{

    public $conn;
    function __construct($dbh)
       {
            $this->conn = $dbh;
       }

   function validate($table1){
    $u_name = $_POST['username'];
    $u_password = $_POST['password'];
    
      $query = "SELECT * FROM $table1 where ID = '$u_name' AND password = '$u_password'";
      $stmt = $this->conn->prepare($query);
      $result = $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row) 
      {
        if (isset($_POST['remember']))
         {
          setcookie("$table1"."username", $u_name , time() + (86400 * 30), "/");// 86400 = 1 day
          setcookie("$table1"."password", $u_password , time() + (86400 * 30), "/");// 86400 = 1 day
        }
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
         }
        $_SESSION[$table1]= $u_name ;
        $_SESSION['loggedin']= true;
        $conn = null;
        if($table1=="admin_credentials")
        {
          header("Location:admin-dashboard.php");
        }
        else if($table1=="student_credentials")
        {
          header("Location:student-dashboard.php");
        }
        else
        {
          header("Location:teacher-dashboard.php");
        }
      
        exit;
      }
      else
      {
        echo '<script>document.getElementById("invalid").innerHTML = "INVALID EMAIL OR PASSWORD!";</script>'; 
      }


   }
   function autofill($table1){
    if(isset($_COOKIE["$table1"."username"]) AND isset($_COOKIE["$table1"."password"]))
    {
      $name=$_COOKIE["$table1"."username"];
      $pass=$_COOKIE["$table1"."password"];
      
      echo"<script>  
      document.getElementById('auto-name').value = '$name';
      document.getElementById('auto-password').value = '$pass';
      </script>
      ";
    }
    
   }









}
















?>