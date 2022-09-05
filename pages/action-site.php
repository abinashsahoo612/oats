<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addsite':
		$s_allotto = mysqli_real_escape_string($db, $_REQUEST['s_allotto']);
		$s_circle = mysqli_real_escape_string($db, $_REQUEST['s_circle']);
		$s_department = mysqli_real_escape_string($db, $_REQUEST['s_department']);
		$s_cluster = mysqli_real_escape_string($db, $_REQUEST['s_cluster']);
		$s_date = mysqli_real_escape_string($db, $_REQUEST['s_date']);
		$s_siteid = mysqli_real_escape_string($db, $_REQUEST['s_siteid']);
		$s_name = mysqli_real_escape_string($db, $_REQUEST['s_name']);
		$s_addr = mysqli_real_escape_string($db, $_REQUEST['s_addrs']);
		$s_wono = mysqli_real_escape_string($db, $_REQUEST['s_wono']);
		$s_cunitprice = mysqli_real_escape_string($db, $_REQUEST['s_cunitprice']);
		$s_vunitprice = mysqli_real_escape_string($db, $_REQUEST['s_vunitprice']);
		$date = date("Y-m-d");
		$s_scope = implode( ",", $_POST['s_scope' ] );

		$results = $db->query("SELECT * FROM `site` WHERE s_sitename='$s_name' AND s_siteid='$s_siteid'");
		$num_rows = $results->num_rows; //mysqli_num_rows($results);
	
		if ($num_rows > 0) {
			
			$_SESSION['msg'] = md5('8');
			header("location: ../add-site-allottment?msg=" . md5('8') . "");
		} else {
		$db->query("INSERT INTO `site` (`s_id`,`s_allotto`,`s_circle`, `s_department`, `s_cluster`, `s_scope`, `s_date`, `s_siteid`, `s_sitename`, `s_addrs`, `s_workno`, `s_cunitprice`, `s_vunitprice`, `s_status`, `s_cdate`) VALUES (NULL, '$s_allotto','$s_circle','$s_department','$s_cluster','$s_scope','$s_date','$s_siteid','$s_name','$s_addr','$s_wono','$s_cunitprice','$s_vunitprice','1','$date')");
		$_SESSION['msg'] = md5('5');
		header("location: ../add-site-allottment?msg=" . md5('5') . "");
		}
	break;
	
	case 'updatesite':
		$s_id = $_REQUEST['s_id'];
		$s_allotto = mysqli_real_escape_string($db, $_REQUEST['s_allotto']);
		$s_circle = mysqli_real_escape_string($db, $_REQUEST['s_circle']);
		$s_department = mysqli_real_escape_string($db, $_REQUEST['s_department']);
		$s_cluster = mysqli_real_escape_string($db, $_REQUEST['s_cluster']);
		$s_date = mysqli_real_escape_string($db, $_REQUEST['s_date']);
		$s_siteid = mysqli_real_escape_string($db, $_REQUEST['s_siteid']);
		$s_name = mysqli_real_escape_string($db, $_REQUEST['s_name']);
		$s_addrs = mysqli_real_escape_string($db, $_REQUEST['s_addrs']);
		$s_wono = mysqli_real_escape_string($db, $_REQUEST['s_wono']);
		$s_cunitprice = mysqli_real_escape_string($db, $_REQUEST['s_cunitprice']);
		$s_vunitprice = mysqli_real_escape_string($db, $_REQUEST['s_vunitprice']);

		$db->query("UPDATE site SET s_allotto='$s_allotto',s_circle='$s_circle',s_department='$s_department',s_cluster='$s_cluster',s_date='$s_date',s_siteid='$s_siteid',s_sitename='$s_name',s_addrs='$s_addrs',s_workno='$s_wono',s_cunitprice='$s_cunitprice',s_vunitprice='$s_vunitprice' WHERE s_id = '$s_id'");
		$_SESSION['msg'] = md5('6');
	header("location: ../add-site-allottment?msg=" . md5('5') . "");
	break;
	case 'pending':
		$s_id = $_REQUEST['s_id'];
		$s_cmpdate = mysqli_real_escape_string($db, $_REQUEST['s_cmpdate']);
		$s_remark = mysqli_real_escape_string($db, $_REQUEST['s_remark']);

		$db->query("UPDATE site SET s_cmpdate='$s_cmpdate',s_remark='$s_remark',s_status='2' WHERE s_id = '$s_id'");
		$_SESSION['msg'] = md5('6');
	header("location: ../add-site-allottment?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$s_id = $_REQUEST['s_id'];
		$db->query("DELETE from site where `s_id`='$s_id'");
		$_SESSION['msg'] = md5('7');
		header("location: ../add-site-allottment.php?msg=" . md5('7') . "");
	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("location: ../dashboard?msg=" . md5('11') . "");
	}	