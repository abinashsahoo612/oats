<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addreason':
		$r_type = mysqli_real_escape_string($db, $_REQUEST['r_type']);
		$r_days = mysqli_real_escape_string($db, $_REQUEST['r_days']);
		$date = date("Y-m-d");
		$tdata = $db->query("SELECT * FROM  reason where r_type = '$r_type'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
			header("location: ../add-abreason?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `reason` (`r_id`, `r_type`, `r_days`, `r_status`, `r_date`) VALUES (NULL, '$r_type','$r_days', '1','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-abreason?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatereason':
		$r_id = $_REQUEST['r_id'];
		$r_type = mysqli_real_escape_string($db, $_REQUEST['r_type']);
		$r_days = mysqli_real_escape_string($db, $_REQUEST['r_days']);
		
		$db->query("UPDATE reason SET r_type='$r_type', r_days='$r_days' WHERE r_id = '$r_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-abreason?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$r_id = $_REQUEST['r_id'];
		$db->query("DELETE from reason where `r_id`='$r_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-abreason.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	