<DOCTYPE html>

  <?php
session_start();
  $mysqli = new mysqli("localhost","login","sH0pM@nAger","shopmanager");
  if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
  }
  for($i=0;$i<$_SESSION["numOrders"];$i++){


    $amount=$_POST["amount".$i];
    $partnum =$_POST["partnumber".$i];
    $rev = $_POST["rev".$i];
    $date = $_POST["date".$i];
    $comments =$_POST["comments".$i];
    $status = 0;
    $mysqli -> query("INSERT INTO orders(amount,partnumber,rev,due_date,comments,status) VALUES('$amount','$partnum','$rev','$date','$comments','$status')");
    if($mysqli->error){
      $_SESSION["message"]= "Error ".$mysqli->error;
      $_SESSION["error"]=1;
    }
    else{

  }
  }
  header("Location: dashboard.php");
  $_SESSION["message"] = "Orders Successfully Added";
  ?>
