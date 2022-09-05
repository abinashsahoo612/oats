<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addrequisition':
		$sr_site = mysqli_real_escape_string($db, $_REQUEST['sr_site']);
		$sr_employee = mysqli_real_escape_string($db, $_REQUEST['sr_employee']);
		$sr_rdate = mysqli_real_escape_string($db, $_REQUEST['sr_rdate']);
		$sr_subscope = mysqli_real_escape_string($db, $_REQUEST['sr_subscope']);
		$sr_rapproval = mysqli_real_escape_string($db, $_REQUEST['sr_rapproval']);
		$sr_rpaiddate = mysqli_real_escape_string($db, $_REQUEST['sr_rpaiddate']);
		// $sr_mparticulars = mysqli_real_escape_string($db, $_REQUEST['sr_mparticulars']);
		// $sr_quantity = mysqli_real_escape_string($db, $_REQUEST['sr_quantity']);
		// $sr_uom = mysqli_real_escape_string($db, $_REQUEST['sr_uom']);
		// $sr_unitprice = mysqli_real_escape_string($db, $_REQUEST['sr_unitprice']);
		// $sr_totalprice = mysqli_real_escape_string($db, $_REQUEST['sr_totalprice']);
		$sr_mpaiddate = mysqli_real_escape_string($db, $_REQUEST['sr_mpaiddate']);
		$date = date("Y-m-d");
		
		$db->query("INSERT INTO `requisition` (`sr_id`,`sr_site`,`sr_employee`, `sr_rdate`, `sr_subscope`, `sr_rapproval`, `sr_rpaiddate`, `sr_mparticulars`, `sr_quantity`, `sr_uom`, `sr_unitprice`, `sr_totalprice`, `sr_mpaiddate`, `sr_status`, `sr_cdate`) VALUES (NULL, '$sr_site','$sr_employee','$sr_rdate','$sr_subscope','$sr_rapproval','$sr_rpaiddate','','','','','','$sr_mpaiddate','1','$date')");
		$_SESSION['msg'] = md5('5');
		header("location: ../add-site-requisition?msg=" . md5('5') . "");
	
	break;
	
	case 'updaterequisition':
		$sr_id = $_REQUEST['sr_id'];
		$sr_site = mysqli_real_escape_string($db, $_REQUEST['sr_site']);
		$sr_employee = mysqli_real_escape_string($db, $_REQUEST['sr_employee']);
		$sr_rdate = mysqli_real_escape_string($db, $_REQUEST['sr_rdate']);
		$sr_subscope = mysqli_real_escape_string($db, $_REQUEST['sr_subscope']);
		$sr_rapproval = mysqli_real_escape_string($db, $_REQUEST['sr_rapproval']);
		$sr_rpaiddate = mysqli_real_escape_string($db, $_REQUEST['sr_rpaiddate']);
		// $sr_mparticulars = mysqli_real_escape_string($db, $_REQUEST['sr_mparticulars']);
		// $sr_quantity = mysqli_real_escape_string($db, $_REQUEST['sr_quantity']);
		// $sr_uom = mysqli_real_escape_string($db, $_REQUEST['sr_uom']);
		// $sr_unitprice = mysqli_real_escape_string($db, $_REQUEST['sr_unitprice']);
		// $sr_totalprice = mysqli_real_escape_string($db, $_REQUEST['sr_totalprice']);
		$sr_mpaiddate = mysqli_real_escape_string($db, $_REQUEST['sr_mpaiddate']);

		$db->query("UPDATE requisition SET sr_site='$sr_site',sr_employee='$sr_employee',sr_rdate='$sr_rdate',sr_subscope='$sr_subscope',sr_rapproval='$sr_rapproval',sr_rpaiddate='$sr_rpaiddate',sr_mpaiddate='$sr_mpaiddate'  WHERE sr_id = '$sr_id'");
		$_SESSION['msg'] = md5('6');
	header("location: ../add-site-requisition?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$sr_id = $_REQUEST['sr_id'];
		$db->query("DELETE from requisition where `sr_id`='$sr_id'");
		$_SESSION['msg'] = md5('7');
		header("location: ../add-site-requisition.php?msg=" . md5('7') . "");

	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("location: ../dashboard?msg=" . md5('11') . "");
	}	