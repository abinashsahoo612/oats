<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
	case 'addmonth':
		$year = mysqli_real_escape_string($db, $_REQUEST['year']);
		$m_month = mysqli_real_escape_string($db, $_REQUEST['m_month']);
		$m_month = mysqli_real_escape_string($db, $_REQUEST['m_month']);
		$date = date("Y-m-d");
		$tdata = $db->query("SELECT * FROM  month where m_month = '$m_month'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
			header("location: ../add-month?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `month` (`m_id`, `m_year`,`m_month`, `m_days`,`m_status`, `m_date`) VALUES (NULL, '$year','$m_month','$m_days', '1','$date')");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-month?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatemonth':
		$m_id = $_REQUEST['m_id'];
		$year = mysqli_real_escape_string($db, $_REQUEST['year']);
		$m_month = mysqli_real_escape_string($db, $_REQUEST['m_month']);
		$m_days = mysqli_real_escape_string($db, $_REQUEST['m_days']);
		$db->query("UPDATE month SET m_year='$year',m_month='$m_month',m_days='$m_days' WHERE m_id = '$m_id'");
		$_SESSION['msg'] = md5('6');
	header("Location: ../add-month?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$m_id = $_REQUEST['m_id'];
		$db->query("DELETE from month where `m_id`='$m_id'");
		$_SESSION['msg'] = md5('7');
		header("Location: ../add-month.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	