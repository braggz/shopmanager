<!DOCTYPE html>
<?php
session_start();
$acount =0;
echo "numorders: ".$_SESSION["numOrders"];
if($_SESSION["isLoggedIn"] != 1){
  header("Location: index.php");
  $_SESSION["message"] = "You Must Logged in to Access the DashBoard";
  //$_POST["loginInfo"] = "You Must Login to Enter Dashboard";
 exit();

}
$auth = $_SESSION["auth"];
$mysqli = new mysqli("localhost","login","sH0pM@nAger","shopmanager");
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
//echo $_SESSION["numOrders"]. " ";
for($i=0;$i<$_SESSION["numOrders"];$i++){
  //echo $i;
  $id = $_SESSION["id".$i];
  $millnum =$_POST["millnum".$i];
  $partnumber =$_POST["partnumber".$i];
  $employee =$_POST["employee".$i];
  $date =$_POST["task_date".$i];
  $comments =$_POST["comments".$i];
  $task = $_POST["task".$i];
  //echo "id: ".$id. ", ".$amount. ", ". $partnumber. ", ". $rev. ", ". $date.", ". $comments. ", ". $status;
 $sql = "UPDATE schedule SET millnum ='$millnum', partnumber = '$partnumber',employee='$employee',task_date='$date',comments='$comments',task = '$task' WHERE id = '$id'";
  if($mysqli->query($sql)== TRUE){
    //echo "It worked";
    header("Location: dashboard.php");
    $_SESSION["message"] = "Orders Have Been Successfully Updated!";
  }
  //else echo $mysqli->error;
}
?>
