<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addholiday':
		$h_name = mysqli_real_escape_string($db, $_REQUEST['h_name']);
		$h_type = mysqli_real_escape_string($db, $_REQUEST['h_type']);
		$date = date("Y-m-d");
		$tdata = $db->query("SELECT * FROM  holiday where h_name = '$h_name',h_type = '$h_type'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
		$_SESSION['msg'] = md5('8');
			header("location: ../add-holiday?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `holiday` (`h_id`, `h_type`,`h_name`, `h_status`, `h_date`) VALUES (NULL, '$h_type','$h_name', '1','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-holiday?msg=" . md5('5') . "");
		}
	break;
	
	case 'updateholiday':
		$h_id = $_REQUEST['h_id'];
		$h_name = mysqli_real_escape_string($db, $_REQUEST['h_name']);
		$h_type = mysqli_real_escape_string($db, $_REQUEST['h_type']);
		
		$db->query("UPDATE holiday SET h_name='$h_name',h_type='$h_type' WHERE h_id = '$h_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-holiday?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$h_id = $_REQUEST['h_id'];
		$db->query("DELETE from holiday where `h_id`='$h_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-holiday.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	