<?php
  header("Cache-Control: max-age=2592000"); //30days (60sec * 60min * 24hours * 30days)

?>
<?php

$an="9842720874";
if($_GET['mobile']==$am){
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}}?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link  href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="javamobile.js"></script>
<script type="text/javascript">SA.redirection_mobile({noredirection_param: "noredirection",mobile_url: "chinnarajutraders.bugs3.com/mobile/",cookie_hours: "2",keep_path: "true"});</script>
<title>Welcome to chinnarajutraders.co.nr</title>

</head>

<body background="BG.jpg" class="container" >
<div class="jumbotron col-md-6 col-md-offset-3" style="margin-top:10%;margin-bottom:10%"><h1 style="font-family: Trebuchet MS,Tahoma,Verdana,Arial,sans-serif;color: #F00" align="center" >CHINNARAJU TRADERS</h1>
<br />
<p align="right"><a href="logout.php" class="btn btn-danger" >logout</a></p>
<br />
<div class="btn-group btn-group-justified">
  <div class="btn-group">
    <a href="ms.php" class="btn btn-primary">MS</a>
  </div>
  <div class="btn-group">
    <a href="hsd.php" class="btn btn-primary">HSD</a>
  </div>
  <div class="btn-group">
    <a href="oil.php" class="btn btn-primary">OIL</a>
  </div>
</div></div>
</body>
</html>