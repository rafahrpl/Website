<?php
  include("backend/connection.php");
  
  //Verifica se um formulário foi enviado
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
      //Make a security form
      function anti_injection($data) {
        $data = stripslashes($data);			//Un-quotes a quoted string
        $data = htmlspecialchars($data);	//Transform data from symbos to secure form of Cross-site scripting (XSS)
        $data = strip_tags($data);				//Remove tags html
        $data = trim($data);							//Strip whitespace (or other characters) from the beginning and end of a string
        return $data;
      }

      $email = anti_injection($_POST["email"]);

      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      //Set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      //Define sql query
      $sql = "DELETE FROM register WHERE email=:email";
      //Prepare statement //sql to delete a record
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      
      //Execute the query
      $stmt->execute();

      echo "Records and realty deleted successfully";

    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
    
    $conn = null;

    header("Refresh:2");
  }
?>
