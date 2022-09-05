<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addsamount':
		$se_type = mysqli_real_escape_string($db, $_REQUEST['se_type']);
		$se_percentage = mysqli_real_escape_string($db, $_REQUEST['se_percentage']);
		$date = date("Y-m-d");
		

		$tdata = $db->query("SELECT * FROM  salryamount where se_type = '$se_type' ");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
			header("location: ../add-samountsetup?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `salryamount` (`se_id`, `se_type`,`se_percentage`, `se_status`, `se_date`) VALUES (NULL, '$se_type','$se_percentage', '1','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-samountsetup?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatesamount':
		$se_id = $_REQUEST['se_id'];
		$se_type = mysqli_real_escape_string($db, $_REQUEST['se_type']);
		$se_percentage = mysqli_real_escape_string($db, $_REQUEST['se_percentage']);
		
		$db->query("UPDATE salryamount SET se_type='$se_type',se_percentage='$se_percentage' WHERE se_id = '$se_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-samountsetup?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$se_id = $_REQUEST['se_id'];
		$db->query("DELETE from salryamount where `se_id`='$se_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-samountsetup.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	