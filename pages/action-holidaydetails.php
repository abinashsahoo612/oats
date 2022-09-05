<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addhdetails':
		$hd_name = mysqli_real_escape_string($db, $_REQUEST['hd_name']);
		$hd_date = mysqli_real_escape_string($db, $_REQUEST['hd_date']);
		$date = date("Y-m-d");

		$sqlh = $db->query("SELECT * FROM holiday where h_id = '$hd_name'");
		$queryh = $sqlh->fetch_object();
		$type=$queryh->h_type;
		if($type == 'Other'){
			$status = 1;
		} else{
			$status = 2;
		}


		$tdata = $db->query("SELECT * FROM  holiday where hd_date = '$hd_date' ");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
			header("location: ../add-holidaydetails?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `holidaydetails` (`hd_id`, `hd_name`, `hd_date`,`hd_status`, `hd_cdate`) VALUES (NULL, '$hd_name','$hd_date', '$status','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-holidaydetails?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatehdetails':
		$hd_id = $_REQUEST['hd_id'];
		$hd_name = mysqli_real_escape_string($db, $_REQUEST['hd_name']);
		$hd_date = mysqli_real_escape_string($db, $_REQUEST['hd_date']);

		

		$sqlh = $db->query("SELECT * FROM holiday where h_id = '$hd_name'");
		$queryh = $sqlh->fetch_object();
		$type=$queryh->h_type;
		if($type == 'Other'){
			$status = 1;
		} else{
			$status = 2;
		}
		
		$db->query("UPDATE holidaydetails SET hd_name='$hd_name',hd_date='$hd_date',hd_status='$status'  WHERE hd_id = '$hd_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-holidaydetails?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$hd_id = $_REQUEST['hd_id'];
		$db->query("DELETE from holidaydetails where `hd_id`='$hd_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-holidaydetails.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	