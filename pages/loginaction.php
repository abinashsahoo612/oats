<?php 
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];

if ($action === 'Login') {
	$a_email = $_POST['a_email'];
	$a_password = md5($_POST['a_password']);
	
	//get total number of records
	$results = $db->query("SELECT * FROM `admin` WHERE a_email='$a_email' AND a_password='$a_password'");
	$num_rows = $results->num_rows; //mysqli_num_rows($results);
	
	if ($num_rows > 0) {
		$value = $db->query("SELECT a_id, a_email, a_usertype,a_pagepermission FROM `admin` WHERE a_email='$a_email'");
		while ($row = $value->fetch_object()) {
			session_regenerate_id();
			$sid = session_id();
			$_SESSION['OATS'] = $sid;
			$_SESSION['logintype'] = 'Admin'; // set user type
			$_SESSION['a_id'] = $row->a_id;
			$_SESSION['a_email'] = $row->a_email;
			$_SESSION['a_usertype'] = $row->a_usertype;
			$_SESSION['a_pagepermission'] = $row->a_pagepermission;
			$db->close();
			$_SESSION['msg'] = md5('9');
			header("Location:../dashboard?msg=" . md5('9') . "");
		}
	} else {
		$_SESSION['msg'] = md5('2');
		header("Location:../index?msg=" . md5('2') . "");
	}
}
if (md5($action) === md5('logout')) {
	unset($_SESSION['OATS']);
	unset($_SESSION['logintype']); // set user type
	unset($_SESSION['a_id']);
	unset($_SESSION['a_email']);
	unset($_SESSION['a_usertype']);
	unset($_SESSION['a_pagepermission']);
	$_SESSION['msg'] = md5('1');
	header("Location:../index?msg=" . md5('logout') . "");
	exit();
}
