<DOCTYPE html>

  <?php
session_start();
  $mysqli = new mysqli("localhost","login","sH0pM@nAger","shopmanager");
  if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
  }
  for($i=0;$i<$_SESSION["numOrders"];$i++){


    $millnumber=$_POST["millnum".$i];
    $emp=$_POST["employee".$i];
    $task = $_POST["task".$i];
    $date = $_POST["task_date".$i];
    $comments =$_POST["comments".$i];
    $partnum = $_POST["partnumber".$i];
    //$status = 0;
    $mysqli -> query("INSERT INTO schedule(millnum,employee,partnumber,task_date,comments,task) VALUES('$millnumber','$emp','$partnum','$date','$comments','$task')");
    if($mysqli->error){
      $_SESSION["message"]= "Error ".$mysqli->error;
      $_SESSION["error"]=1;
    }
    else{

  }
  }
  header("Location: dashboard.php");
  $_SESSION["message"] = "Mills Successfully Added";
  ?>
