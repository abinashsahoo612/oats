<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'adddepartment':
		$d_name = mysqli_real_escape_string($db, $_REQUEST['d_name']);
		$date = date("Y-m-d");
		$tdata = $db->query("SELECT * FROM  department where d_name = '$d_name'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
			header("location: ../add-department?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `department` (`d_id`, `d_name`, `d_status`, `d_date`) VALUES (NULL, '$d_name', '1','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-department?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatedepartment':
		$d_id = $_REQUEST['d_id'];
		$d_name = mysqli_real_escape_string($db, $_REQUEST['d_name']);
		
		$db->query("UPDATE department SET d_name='$d_name' WHERE d_id = '$d_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-department?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$d_id = $_REQUEST['d_id'];
		$db->query("DELETE from department where `d_id`='$d_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-department.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	