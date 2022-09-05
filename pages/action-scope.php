<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addscope':
		$s_name = mysqli_real_escape_string($db, $_REQUEST['s_name']);
		$date = date("Y-m-d");
		$tdata = $db->query("SELECT * FROM  scope where s_name = '$s_name'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
			header("location: ../add-scope?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `scope` (`s_id`, `s_name`, `s_status`, `s_date`) VALUES (NULL, '$s_name', '1','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-scope?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatescope':
		$s_id = $_REQUEST['s_id'];
		$s_name = mysqli_real_escape_string($db, $_REQUEST['s_name']);
		
		$db->query("UPDATE scope SET s_name='$s_name' WHERE s_id = '$s_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-scope?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$s_id = $_REQUEST['s_id'];
		$db->query("DELETE from scope where `s_id`='$s_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-scope.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	