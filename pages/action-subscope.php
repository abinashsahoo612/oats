<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addsubscope':
		$sc_name = mysqli_real_escape_string($db, $_REQUEST['sc_name']);
		$sc_scope = mysqli_real_escape_string($db, $_REQUEST['sc_scope']);
		$date = date("Y-m-d");
		$tdata = $db->query("SELECT * FROM  subscope where sc_name = '$sc_name'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
			header("location: ../add-subscope?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `subscope` (`sc_id`, `sc_name`, `sc_scope`,`sc_status`, `sc_date`) VALUES (NULL, '$sc_name','$sc_scope', '1','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-subscope?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatesubscope':
		$sc_id = $_REQUEST['sc_id'];
		$sc_name = mysqli_real_escape_string($db, $_REQUEST['sc_name']);
		echo $sc_scope = mysqli_real_escape_string($db, $_REQUEST['sc_scope']);
		
		$db->query("UPDATE subscope SET sc_name='$sc_name',sc_scope='$sc_scope' WHERE sc_id = '$sc_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-subscope?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$sc_id = $_REQUEST['sc_id'];
		$db->query("DELETE from subscope where `sc_id`='$sc_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-subscope.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	