<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addcluster':
		$c_name = mysqli_real_escape_string($db, $_REQUEST['c_name']);
		$date = date("Y-m-d");
		
		$tdata = $db->query("SELECT * FROM  cluster where c_name = '$c_name'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
		$_SESSION['msg'] = md5('8');
			header("location: ../add-cluster?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `cluster` (`c_id`, `c_name`, `c_status`, `c_date`) VALUES (NULL, '$c_name', '1','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-cluster?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatecluster':
		$c_id = $_REQUEST['c_id'];
		$c_name = mysqli_real_escape_string($db, $_REQUEST['c_name']);
		
		$db->query("UPDATE cluster SET c_name='$c_name' WHERE c_id = '$c_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-cluster?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$c_id = $_REQUEST['c_id'];
		$db->query("DELETE from cluster where `c_id`='$c_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-cluster.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	