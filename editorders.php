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
  $amount =$_POST["amount".$i];
  $partnumber =$_POST["partnumber".$i];
  $rev =$_POST["rev".$i];
  $date =$_POST["due_date".$i];
  $comments =$_POST["comments".$i];
  $status = $_POST["status".$i];
  echo "id: ".$id. ", ".$amount. ", ". $partnumber. ", ". $rev. ", ". $date.", ". $comments. ", ". $status;
 $sql = "UPDATE orders SET amount ='$amount', partnumber = '$partnumber',rev='$rev',due_date='$date',comments='$comments',status = '$status' WHERE id = '$id'";
  if($mysqli->query($sql)== TRUE){
    //echo "It worked";
    header("Location: dashboard.php");
    $_SESSION["message"] = "Orders Have Been Successfully Updated!";
  }
  //else echo $mysqli->error;
}
?>
