<?php
  session_start();
  $_SESSION["isLoggedIn"] = 0;
  session_destroy();
  header("Location: index.php");
  exit();
?>
