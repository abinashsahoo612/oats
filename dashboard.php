<?php
session_start();
require_once 'config/config.php';
require_once 'config/helper.php';
if (!empty($_SESSION['OATS'])) {
  if ($_SESSION['OATS'] != session_id() && $_SESSION['logintype'] != 'Admin') {
    header('Location: index');
    exit;
  }
} else {
  header('Location: index');
  exit;
}
$logintype = $_SESSION['logintype'];
$a_idchk = $_SESSION['a_id'];
$atype = $_SESSION['a_usertype'];
ob_start("ob_html_compress");
$data = $db->query("SELECT * FROM admin WHERE 	a_usertype = '1'");
$row = $data->fetch_object();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard</title>
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700,700i" rel="stylesheet">
    <?php include_once 'header.php'; ?>
	<style>
		.introhead{font-family: 'Josefin Sans', sans-serif;color:#0EAEE9;font-weight:bold;}
		p{font-family: Impact, Charcoal, sans-serif;text-align:center;margin-top:30px; font-size:40px; font-weight:bold;color:#E90EA1;letter-spacing:1px;}
	</style>
  <div id="page-wrapper">
    <?php include_once 'msg.php'; ?> 
    <div class="row">
      <div class="col-lg-12"> 
        <h1 class="page-header introhead text-center">Welcome</h1>
        <img src="dist/images/logo.jpg" class="img-responsive center-block" alt="Logo" style="margin-top:10px;height:100px;width:250px;"/>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row -->
   

  </div>
  <!-- /#page-wrapper --> 
  <?php include_once 'footer.php'; ?>