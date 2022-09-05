<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addbilling':
		$b_site = mysqli_real_escape_string($db, $_REQUEST['b_site']);
		$b_billno = mysqli_real_escape_string($db, $_REQUEST['b_billno']);
		$b_billname = mysqli_real_escape_string($db, $_REQUEST['b_billname']);
		$b_billamount = mysqli_real_escape_string($db, $_REQUEST['b_billamount']);
		$b_prdate = mysqli_real_escape_string($db, $_REQUEST['b_prdate']);
		$b_pramount = mysqli_real_escape_string($db, $_REQUEST['b_pramount']);
		$b_pstatus = mysqli_real_escape_string($db, $_REQUEST['b_pstatus']);
		$b_remark = mysqli_real_escape_string($db, $_REQUEST['b_remark']);
		$b_tdeductamount = mysqli_real_escape_string($db, $_REQUEST['b_tdeductamount']);
		$b_rdeductamount = mysqli_real_escape_string($db, $_REQUEST['b_rdeductamount']);
		$date = date("Y-m-d");
		
		$db->query("INSERT INTO `billing` (`b_id`,`b_site`,`b_billno`, `b_billname`, `b_billamount`, `b_rdeductamount`, `b_tdeductamount`,`b_prdate`, `b_pramount`, `b_pstatus`, `b_remark`, `b_status`, `b_cdate`) VALUES (NULL, '$b_site','$b_billno','$b_billname','$b_billamount','$b_rdeductamount','$b_tdeductamount','$b_prdate','$b_pramount','$b_pstatus','$b_remark','1','$date')");
		$_SESSION['msg'] = md5('5');
		header("location: ../add-site-billing?msg=" . md5('5') . "");
	
	break;
	
	case 'updatebilling':
		$b_id = $_REQUEST['b_id'];
		$b_site = mysqli_real_escape_string($db, $_REQUEST['b_site']);
		$b_billno = mysqli_real_escape_string($db, $_REQUEST['b_billno']);
		$b_billname = mysqli_real_escape_string($db, $_REQUEST['b_billname']);
		$b_billamount = mysqli_real_escape_string($db, $_REQUEST['b_billamount']);
		$b_prdate = mysqli_real_escape_string($db, $_REQUEST['b_prdate']);
		$b_pramount = mysqli_real_escape_string($db, $_REQUEST['b_pramount']);
		$b_pstatus = mysqli_real_escape_string($db, $_REQUEST['b_pstatus']);
		$b_remark = mysqli_real_escape_string($db, $_REQUEST['b_remark']);
		$b_tdeductamount = mysqli_real_escape_string($db, $_REQUEST['b_tdeductamount']);
		$b_rdeductamount = mysqli_real_escape_string($db, $_REQUEST['b_rdeductamount']);

		$db->query("UPDATE billing SET b_site='$b_site',b_billno='$b_billno',b_billname='$b_billname',b_billamount='$b_billamount',b_tdeductamount='$b_tdeductamount',b_rdeductamount='$b_rdeductamount',b_prdate='$b_prdate',b_pramount='$b_pramount',b_pstatus='$b_pstatus',b_remark='$b_remark' WHERE b_id = '$b_id'");
		$_SESSION['msg'] = md5('6');
	header("location: ../add-site-billing?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$b_id = $_REQUEST['b_id'];
		$db->query("DELETE from billing where `b_id`='$b_id'");
		$_SESSION['msg'] = md5('7');
		header("location: ../add-site-billing.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("location: ../dashboard?msg=" . md5('11') . "");
	}	