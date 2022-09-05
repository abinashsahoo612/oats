<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addcircle':
		$c_name = mysqli_real_escape_string($db, $_REQUEST['c_name']);
		$date = date("Y-m-d");
		$tdata = $db->query("SELECT * FROM  circle where c_name = '$c_name'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
			header("location: ../add-circle?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `circle` (`c_id`, `c_name`, `c_status`, `c_date`) VALUES (NULL, '$c_name', '1','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-circle?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatecircle':
		$c_id = $_REQUEST['c_id'];
		$c_name = mysqli_real_escape_string($db, $_REQUEST['c_name']);
		
		$db->query("UPDATE circle SET c_name='$c_name' WHERE c_id = '$c_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-circle?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$c_id = $_REQUEST['c_id'];
		$db->query("DELETE from circle where `c_id`='$c_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-circle.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	