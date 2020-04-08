<html>
  <?php
    $username = $_POST["username"];
    $password = $_POST["password"];

    $mysqli = new mysqli("localhost","login","sH0pM@nAger","shopmanager");
    if ($mysqli -> connect_errno) {
  	echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  	exit();
  	}

    $result = $mysqli -> query("SELECT username, password FROM users where username= '$username' ");
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if($password == $row["password"]){
        echo "Login Success";
      }
      else {
        echo "<h1>Incorrect Password</h1>";
      }
    }
    else {
      echo "<h1>No User Found. Please Contact SysAdmin if Problem persists<h1>";
    }

    //if($match_user = $username){
      //echo "Success";
    //}
    //else echo "Failure";


    ?>



</html>
