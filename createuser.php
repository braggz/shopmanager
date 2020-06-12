<!DOCTYPE html>
<?php
session_start();
//$message = "";
if($_SESSION["isLoggedIn"] != 1){
  header("Location: index.php");
  $_SESSION["message"] = "You Must Logged in to Access This";
  //$_POST["loginInfo"] = "You Must Login to Enter Dashboard";
 exit();
}
else if($_SESSION["auth"] < 3){
  header("Location: index.php");
  $_SESSION["message"] = "You are not authorized to do this";
}
else if(isset($_POST["username"])){
  echo "adsdsa";
  if(!isset($_POST["password"]) || !isset($_POST["passwordcheck"])){
    $message = "Need a Password!";
  }
  $mysqli = new mysqli("localhost","login","sH0pM@nAger","shopmanager");
  if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
  }
  $username = $_POST["username"];
  $password = $_POST["password"];
  $auth = $_POST["auth"];
  $result = $mysqli -> query("SELECT username FROM users where username= '$username' ");
  if($_POST["password"] != $_POST["passwordcheck"]){
    $message = "Passwords do not match";
  }
  else if($result->num_rows > 0){
    $message = "Username already exists";

  }
  else{
    $result = $mysqli -> query("INSERT INTO users (username, password, auth) VALUES ('$username','$password','$auth') ");
    header("Location: dashboard.php");
    $_SESSION["message"] = "New Employee Added!";
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<script type="text/javascript" src="jquery.js">
</script>
<script type="text/javascript" src="jquery-ui.min.js">
</script>
<script type="text/javascript" src="bootstrap.min.js">
</script>
<script type="text/javascript" src="customjs.js">
</script>
<script type="text/javascript" src="tt_animation.js">
</script>
<script type="text/javascript" src="contactform.js">
</script>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="description" content="Meta Description" />
<title>
Create A New User
</title>
<link rel="stylesheet"  href="bootstrap.css" type="text/css" media="screen"/>
<link rel="stylesheet"  href="style.css" type="text/css" media="screen"/>
<!--[if lte IE 8]>
<link rel="stylesheet"  href="menuie.css" type="text/css" media="screen"/>
<link rel="stylesheet"  href="vmenuie.css" type="text/css" media="screen"/>
<![endif]-->
<script type="text/javascript" src="totop.js">
</script>
<script type="text/javascript" src="tt_animation.js">
</script>
<!--[if IE 7]>
<style type="text/css" media="screen">
#ttr_vmenu_items  li.ttr_vmenu_items_parent {margin-left:-16px;font-size:0px;}
</style>
<![endif]-->
<!--[if lt IE 9]>
<script type="text/javascript" src="html5shiv.js">
</script>
<script type="text/javascript" src="respond.min.js">
</script>
<![endif]-->
</head>
<body class="createuser">
<div class="totopshow">
<a href="#" class="back-to-top"><img alt="Back to Top" src="images/gototop0.png"/></a>
</div><!-- totopshow -->
<div class="margin_collapsetop"></div>
<div class="margin_collapsetop"></div>
<div id="ttr_page" class="container">
<div id="ttr_menu">
<div class="margin_collapsetop"></div>
<nav class="navbar-default navbar-expand-md navbar">
<div id="ttr_menu_inner_in">
<div id="navigationmenu">
<div class="ttr_menu_element_alignment container">
</div>
<div class="ttr_images_container">
<div class="ttr_menu_logo">
</div>
</div>
<div class="navbar-header">
<button id="nav-expander" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
<span class="ttr_menu_toggle_button">
<span class="sr-only">
</span>
<span class="icon-bar navbar-toggler-icon">
</span>
<span class="icon-bar navbar-toggler-icon">
</span>
<span class="icon-bar navbar-toggler-icon">
</span>
</span>
<span class="ttr_menu_button_text">
Menu
</span>
</button>
</div>
<div class="menu-center collapse navbar-collapse">
<ul class="ttr_menu_items nav navbar-nav nav-center">
<li class="ttr_menu_items_parent dropdown"><a href="index.php" class="ttr_menu_items_parent_link"><span class="menuchildicon"></span>Home</a>
<hr class ="horiz_separator"/>
</li> <!-- main menu list closing -->
<li class="ttr_menu_items_parent dropdown active"><a href="customer-portal.php" class="ttr_menu_items_parent_link_active"><span class="menuchildicon"></span>Customer Portal</a>
<hr class ="horiz_separator"/>
</li> <!-- main menu list closing -->
<li class="ttr_menu_items_parent dropdown"><a href="dashboard.php" class="ttr_menu_items_parent_link"><span class="menuchildicon"></span>Dash Board</a>
<hr class ="horiz_separator"/>
</li> <!-- main menu list closing -->
<?php

  if($_SESSION["isLoggedIn"] != 1){


   echo "<li class=\"ttr_menu_items_parent dropdown\"><a href=\"login.php\" class=\"ttr_menu_items_parent_link\"><span class=\"menuchildicon\"></span>Login</a>";
  }
  else{

  echo  "<li class=\"ttr_menu_items_parent dropdown\"><a href=\"logout.php\" class=\"ttr_menu_items_parent_link\"><span class=\"menuchildicon\"></span>Logout</a>";
  }



?>
</li> <!-- main menu list closing -->
</ul>
</div>
</div>
</div>
</nav>
</div>
<div id="ttr_content_and_sidebar_container">
<div id="ttr_content">
<div id="ttr_html_content_margin" class="container-fluid">
<h1 class="ttr_page_title">
Add New Employee
</h1>
<div class="margin_collapsetop"></div>
<div class="ttr_createuser_html_row0 row" >
<div class="post_column col-xl-12 col-lg-12 col-md-3 col-sm-3 col-xs-3 col-3">
<div class="ttr_createuser_html_column00">
<div class="margin_collapsetop"></div>
<div class="html_content">
  <h1> Plear enter Information for new Employees Account </h1>
    <form action = "createuser.php" method ="post" style="float:left;width:25%;" >
      <input type = "text" name = "username" placeholder="Enter Username" style="margin-bottom:5px;with:20%;">
      <input type = "password" name="password" placeholder="Enter Passworld" style="margin-bottom:5px;">
      <input type = "password" name="passwordcheck" placeholder="Enter Passworld Again" style="margin-bottom:5px;">
      <p> Please Enter Employees Rank </p>
      <input type="radio" name="auth" value = "1" id="rank1" checked>
      <label for="rank1">Standard Employee</label>
      <input type="radio" name="auth" value = "3" id="rank2">
      <label for="rank2" >Manager</label>
      <br>
      <button type="submit"> Add Employee</button>
        </form>
        <?php echo "<p style = \"color:red\">".$message."</p>";
        $message ="";?>

</div>
<div class="margin_collapsetop"></div>
<div style="clear:both;width:0px;"></div>
</div>
</div>
<div class=" visible-lg-block d-xl-block d-lg-block" style="clear: both;width:0px;"></div>
</div>
<div class="margin_collapsetop"></div>
</div><!--content_margin-->
</div><!--content-->
<div style="clear:both">
</div>
</div><!--container-->
<div class="margin_collapsetop"></div>
<footer id="ttr_footer">
<div class="margin_collapsetop"></div>
 <div id="ttr_footer_inner">
<div class="ttr_footer-widget-cell_inner_widget_container">
<div class="ttr_footer-widget-cell_inner0 container row">
<div class="post_column col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div class="footercellcolumn1">
<div class="margin_collapsetop"></div>
<div class="html_content"><h4 style="line-height: normal;"><span style="color:rgba(0,0,0,1);">Company</span></h4><p>Lorem ipsum dolor sit amet, test link adipiscing elit.Nullam dignissim convallis est.Quisque aliquam. Donec faucibus. Nunc iaculis suscipit dui.</p></div>
<div class="margin_collapsetop"></div>
</div>
</div>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear: both;"></div>
<div class="post_column col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div class="footercellcolumn2">
<div class="margin_collapsetop"></div>
<div class="html_content"><h4 style="line-height: normal;"><span style="color:rgba(0,0,0,1);">Pages</span></h4><p style="line-height: normal;">Home</p><p style="line-height: normal;">About</p><p style="line-height: normal;">Contact</p><p style="line-height: normal;">Blog</p></div>
<div class="margin_collapsetop"></div>
</div>
</div>
<div class=" visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear: both;"></div>
<div class="post_column col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div class="footercellcolumn3">
<div class="margin_collapsetop"></div>
<div class="html_content"><h4 style="line-height: normal;"><span style="color:rgba(0,0,0,1);">Address</span></h4><p style="line-height: normal;">123 ABC Ave Street View #456 XYZ</p><p style="line-height: normal;">New York City</p><p style="line-height: normal;">NY 10005, USA</p></div>
<div class="margin_collapsetop"></div>
</div>
</div>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear: both;"></div>
<div class="post_column col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div class="footercellcolumn4">
<div class="margin_collapsetop"></div>
<div class="html_content"><br /></div>
<div class="margin_collapsetop"></div>
</div>
</div>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear: both;"></div>
<div class=" visible-lg-block d-xl-block d-lg-block visible-md-block d-md-block visible-sm-block d-sm-block visible-xs-block d-block" style="clear:both;"></div>
</div>
</div>
<div class="ttr_footer_bottom_footer">
<div class="ttr_footer_bottom_footer_inner">
<div class="ttr_footer_element_alignment container">
</div>
<div id="ttr_footer_designed_by_links">
<a href="http://templatetoaster.com" target="_self" >
Website
</a>
<span id="ttr_footer_designed_by">
Designed With TemplateToaster
</span>
</div>
</div>
</div>
</div>
</footer>
<div class="margin_collapsebottom"></div>
</div><!--page-->
</body>
</html>
