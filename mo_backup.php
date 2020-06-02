<!DOCTYPE html>

<?php
$acount =0;
session_start();
  //echo $_SESSION["numOrders"];
  $mysqli = new mysqli("localhost","login","sH0pM@nAger","shopmanager");
  if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
echo "<form action = \"editorders.php\" method = \"post\">";
  for($i=0;$i<$_SESSION["numOrders"];$i++){
    if(isset($_POST[$i])){
      $acount++;
    $id = $_POST[$i];
    //echo $id;
    $result = $mysqli -> query("SELECT amount, partnumber,rev,due_date,comments,status FROM orders WHERE id ='$id'");

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){

        echo "<input type = \"text\" name = \"amount".$acount." \" value=\" ".$row["amount"]." \"> ";
        echo "<input type = \"text\" name = \"partnumber".$acount." \" value=\" ".$row["partnumber"]." \"> ";
        echo "<input type = \"text\" name = \"rev".$acount."\" value=\" ".$row["rev"]." \"> ";
        $date = $row["due_date"];
        $date = strval($date);
        //echo $date;
        echo "<input type =\"date\" value =\"".$date."\">";
    //    echo "<input type = \"date\" name = \"due_date".$acount." \" value=\" 2000-10-10 \"> ";
        echo "<input type = \"text\" name = \"comments".$acount." \" value=\" ".$row["comments"]." \"> ";
        echo "<input type = \"text\" name = \"status".$acount." \" value=\" ".$row["status"]." \"> ";
        echo "<br>";
      }
    }

}
  //echo $i;

  }
  echo "<button type = \"submit\"> Submit Changes </button>";
  echo "</form>"
 ?>
