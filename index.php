<?php
session_start();
require_once 'config/config.php';
require_once 'config/helper.php';
ob_start("ob_html_compress");

//OFFLINE CODE//

//check internet connection
/* $connected = @fsockopen("www.example.com", 80);      //website, port  (try 80 or 443)
if ($connected){
	$is_conn = 1; //action when connected '1'
	fclose($connected);
}else{
	$is_conn = 2; //action in connection failure '2'
}

$svalue = '';
//$sdata = $this->admin_model->check_security();
$results = $db->query("SELECT mac_address,mac_address_off FROM sqrty WHERE id = 'shop_web@123'");
$sdata = $results->fetch_object();

if($is_conn == 1){
	if(!empty($sdata->mac_address)) $svalue = $sdata->mac_address;
}else{
	if(!empty($sdata->mac_address_off)) $svalue = $sdata->mac_address_off;
}

ob_start(); // Turn on output buffering
system("ipconfig /all"); //Execute external program to display output
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer
$findme = "Physical";
$pmac = strpos($mycom, $findme); // Find the position of Physical text
$mac=substr($mycom,($pmac+36),17); // Get Physical Address

if(!empty($svalue)) {
	$value=trim($svalue);
	$mac=trim($mac);
	if($value != $mac){
		//$this->load->view('front_error');
		header("Location: auth");
	}
} else {
	//$this->admin_model->security_upadte($mac);
	if($is_conn == 1){
		$db->query("UPDATE sqrty SET mac_address='$mac' WHERE id = 'shop_web@123'");		
	}else{
		$db->query("UPDATE sqrty SET mac_address_off='$mac' WHERE id = 'shop_web@123'");		
	}
	//$this->load->view('front');
} */

//OFFLINE CODE//
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>LOGIN FORM</title>
	<link href="components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="components/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="dist/js/jquery-1.11.1.min.js"></script>
    <style>
      body{background-image:url("dist/images/");color:#ffffff;background-repeat:no-repeat;background-size: cover;}
      .panel-body {padding: 24px;}
      p{text-align:center;margin-top:40px;font-size:25px;font-weight:bold;}
    </style>
  </head>

  <body>
    <div class="container">
		<div class="row">
        <?php include_once 'msg.php'; ?>
			<div class="col-md-4 col-md-offset-4" style="text-align:center; margin-top:30px;">
				<img src="dist/images/logo.jpg" class="img-responsive center-block" alt="Logo" style="margin-top:10px;height:100px;width:200px;"/>
				<div class="login-panel panel panel-default">
					<div class="panel-body" style="background-color: #de5126;">
						<form class="form-signin" method="post" action="pages/loginaction" enctype="multipart/form-data" >
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="a_email" type="email" autofocus title="Please Enter Email">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="a_password" type="password" value="" title="Please Enter Password">
							</div>
							<button style="background-color:#024861;border-color:#0a653b;" class="btn btn-warning btn-block" type="submit">LOGIN</button>
							<input type="hidden" name="submit" value="Login">
						</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
    <?php
    $db->close();
    $_SESSION['msg'] = '0';
    ?>
    <!-- Bootstrap Core JavaScript -->
	<script src="components/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
	<script src="components/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
  </body>
</html>
<?php ob_end_flush(); ?>