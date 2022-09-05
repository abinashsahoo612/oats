<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addlocation':
		$l_name = mysqli_real_escape_string($db, $_REQUEST['l_name']);
		$l_circle = mysqli_real_escape_string($db, $_REQUEST['l_circle']);
		$date = date("Y-m-d");
		$tdata = $db->query("SELECT * FROM  location where l_name = '$l_name'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
			header("location: ../add-location?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `location` (`l_id`, `l_name`, `l_circle`,`l_status`, `l_date`) VALUES (NULL, '$l_name','$l_circle', '1','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-location?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatelocation':
		$l_id = $_REQUEST['l_id'];
		$l_name = mysqli_real_escape_string($db, $_REQUEST['l_name']);
		$l_circle = mysqli_real_escape_string($db, $_REQUEST['l_circle']);
		
		$db->query("UPDATE location SET l_name='$l_name',l_circle='$l_circle' WHERE l_id = '$l_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-location?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$l_id = $_REQUEST['l_id'];
		$db->query("DELETE from location where `l_id`='$l_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-location.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	