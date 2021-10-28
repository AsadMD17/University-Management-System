  <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $result = "*";
     $conn="";
    
      try {
          $conn = new PDO("mysql:host=$servername;dbname=cms", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }        
?>