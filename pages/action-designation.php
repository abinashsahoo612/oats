<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'adddesignation':
		$ds_name = mysqli_real_escape_string($db, $_REQUEST['ds_name']);
		$date = date("Y-m-d");
		$tdata = $db->query("SELECT * FROM  designation where ds_name = '$ds_name'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
		$_SESSION['msg'] = md5('8');
			header("location: ../add-designation?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `designation` (`ds_id`, `ds_name`, `ds_status`, `ds_date`) VALUES (NULL, '$ds_name', '1','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-designation?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatedesignation':
		$ds_id = $_REQUEST['ds_id'];
		$ds_name = mysqli_real_escape_string($db, $_REQUEST['ds_name']);
		
		$db->query("UPDATE designation SET ds_name='$ds_name' WHERE ds_id = '$ds_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-designation?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$ds_id = $_REQUEST['ds_id'];
		$db->query("DELETE from designation where `ds_id`='$ds_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-designation.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	