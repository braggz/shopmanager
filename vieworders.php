<!DOCTYPE html>
<?php
session_start();
if($_SESSION["isLoggedIn"] != 1){
  header("Location: index.php");
  $_SESSION["message"] = "You Must Logged in to Access the DashBoard";
  //$_POST["loginInfo"] = "You Must Login to Enter Dashboard";
 exit();

}
$auth = $_SESSION["auth"];
?>
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
<meta name="description" content="Look at orders" />
<title>
View Orders
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
<body class="vieworders">
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
<li class="ttr_menu_items_parent dropdown"><a href="customer-portal.php" class="ttr_menu_items_parent_link"><span class="menuchildicon"></span>Customer Portal</a>
<hr class ="horiz_separator"/>
</li> <!-- main menu list closing -->
<li class="ttr_menu_items_parent dropdown"><a href="dashboard.php" class="ttr_menu_items_parent_link"><span class="menuchildicon"></span>Dash Board</a>
<hr class ="horiz_separator"/>
</li> <!-- main menu list closing -->
<li class="ttr_menu_items_parent dropdown"><a href="logout.php" class="ttr_menu_items_parent_link"><span class="menuchildicon"></span>Logout</a>
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
View Orders
</h1>
<?php if($auth>=3){
  echo "<form action = \"modifyorders.php\" method = \"post\">";
} ?>
<table width="100%"; style="border:1px solid";    >


<?php

//echo $auth;

  $dt = new DateTime();

  $mysqli = new mysqli("localhost","login","sH0pM@nAger","shopmanager");
  if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  $result = $mysqli -> query("SELECT id,amount, partnumber,rev,due_date,comments,status FROM orders ORDER BY id  DESC ");

//  $result2 = $mysqli -> query("SELECT CONVERT FROM corkboard ORDER BY id  DESC LIMIT 10( posted_date,VARCHAR(50))");
  $status="";
  if ($result->num_rows > 0) {
echo"<th>ID</th>
    <th>Amount</th>
    <th>Part number</th>
    <th>Rev</th>
    <th>Due Date</th>
    <th>Comments</th>
    <th>Status</th>";
    if($auth >= 3){
      echo "<p>Since you are a manger you can edit orders</p>";
      echo "<th> Edit</th>";
    }

    $i=0;
    while($row = $result->fetch_assoc()){
      //$date = new DateTime($row["posted_date"]);
      //$fdate = $date->format('d/m/y H:i');
      echo "<tr>";
      echo "<td style = \"border: 1px solid; padding:6px;\">".$row["id"]."</td>";
      echo "<td style = \"border: 1px solid; padding:6px;\">".$row["amount"]."</td>";
      echo "<td style = \"border: 1px solid;padding:6px;\">"."".$row["partnumber"]."</td>";
      echo "<td style = \"border: 1px solid;padding:6px;\"> "."".$row["rev"]."</td>";
      echo "<td style = \"border: 1px solid;padding:6px;\">"."".$row["due_date"]."</td>";
      echo "<td style = \"border: 1px solid;padding:6px;\">"."".$row["comments"]."</td>";

      switch ($row["status"]) {
        case 0:
          $status = "Received";
          break;
        case 1:
          $status = "Set Up";
          break;
        case 2:
          $status = "Manufacturing";
          break;
        case 3:
          $status = "Debur";
          break;
        case 4:
          $status = "Packageing and Processing";
          break;
        case 5:
          $status = "Shipped";
          break;

        default:
          $status = "Error: Status Not Set ";
          break;
      }
      echo "<td style = \"border: 1px solid;padding:6px;\">"."".$status."</td>";
      if($auth >=3 ){
        echo "<td style = \"border: 1px solid;padding:6px;\">
          <input type = \"checkbox\" name=\"".$i."\" value =\"".$row["id"]."\">

        </td>";
      }
      $i++;
      echo "<tr>";
    }
    $_SESSION["numOrders"] = $i;
    echo "</table>";
    if($auth >= 3){
      echo "<button type =\"submit\">Edit Orders</button>";
      echo "<button type = \"submit\" value = \"1\" name = \"deleteOrders\"> Delete Orders </button>";
      echo "</form>";
    }
  }
  else{
    echo "<h2> No Orders Found</h2>";
  }

  ?>


<div class="margin_collapsetop"></div>
<div class="ttr_vieworders_html_row0 row" >
<div class="post_column col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 col-12">
<div class="ttr_vieworders_html_column00">
<div class="margin_collapsetop"></div>
<div class="html_content"><br /></div>
<div class="margin_collapsetop"></div>
<div style="clear:both;width:0px;"></div>
</div>
</div>
<div class=" visible-sm-block d-sm-block visible-xs-block d-block" style="clear: both;width:0px;"></div>
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
