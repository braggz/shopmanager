<html>
  <?php
  session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];

    $mysqli = new mysqli("localhost","login","sH0pM@nAger","shopmanager");
    if ($mysqli -> connect_errno) {
  	echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  	exit();
  	}

    $result = $mysqli -> query("SELECT username, password,auth FROM users where username= '$username' ");
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION["auth"]=$row["auth"];
      if($username == $row["username"]){
        if($password == $row["password"]){

          $_SESSION["isLoggedIn"] = 1;
          $_SESSION["user"]= $username;
          header("Location: dashboard.php");
          exit();
        }
        else {
          $_SESSION["message"]= "Incorrect Password or Username";
          header("Location: login.php");
          exit();
        }
      }
    }
    else {
      $_SESSION["message"]= "No User Found. Please Contact SysAdmin if Problem persists";
      header("Location: login.php");
      exit();
    }

    //if($match_user = $username){
      //echo "Success";
    //}
    //else echo "Failure";
    mysqli_close($mysqli);

    ?>



</html>
