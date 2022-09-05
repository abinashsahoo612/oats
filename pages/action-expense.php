<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addexpense':
		$se_site = mysqli_real_escape_string($db, $_REQUEST['se_site']);
		$se_employee = mysqli_real_escape_string($db, $_REQUEST['se_employee']);
		$se_eamount = mysqli_real_escape_string($db, $_REQUEST['se_eamount']);
		$se_pamount = mysqli_real_escape_string($db, $_REQUEST['se_pamount']);
		$se_tabillno = mysqli_real_escape_string($db, $_REQUEST['se_tabillno']);
		$se_tadate = mysqli_real_escape_string($db, $_REQUEST['se_tadate']);
		$se_rmaterial = mysqli_real_escape_string($db, $_REQUEST['se_rmaterial']);
		$se_mperticulars = mysqli_real_escape_string($db, $_REQUEST['se_mperticulars']);
		$se_uquantity = mysqli_real_escape_string($db, $_REQUEST['se_uquantity']);
		$se_uom = mysqli_real_escape_string($db, $_REQUEST['se_uom']);
		$se_uprice = mysqli_real_escape_string($db, $_REQUEST['se_uprice']);
		$se_totalprice = mysqli_real_escape_string($db, $_REQUEST['se_totalprice']);
		$se_rquantity = mysqli_real_escape_string($db, $_REQUEST['se_rquantity']);
		$se_rdate = mysqli_real_escape_string($db, $_REQUEST['se_rdate']);
		$date = date("Y-m-d");
		
		$db->query("INSERT INTO `expense` (`se_id`,`se_site`,`se_employee`, `se_eamount`, `se_pamount`, `se_tabillno`, `se_tadate`, `se_rmaterial`, `se_mperticulars`, `se_uquantity`, `se_uom`,`se_uprice`, `se_totalprice`, `se_rquantity`,`se_rdate`, `se_status`, `se_cdate`) VALUES (NULL, '$se_site','$se_employee','$se_eamount','$se_pamount','$se_tabillno','$se_tadate','$se_rmaterial','$se_mperticulars','$se_quantity','$se_uom','$se_uprice','$se_totalprice','$se_rquantity','$se_rdate','1','$date')");
		$_SESSION['msg'] = md5('5');
		header("location: ../add-site-expense?msg=" . md5('5') . "");
	
	break;
	
	case 'updateexpense':
		$se_id = $_REQUEST['se_id'];
		$se_site = mysqli_real_escape_string($db, $_REQUEST['se_site']);
		$se_employee = mysqli_real_escape_string($db, $_REQUEST['se_employee']);
		$se_eamount = mysqli_real_escape_string($db, $_REQUEST['se_eamount']);
		$se_pamount = mysqli_real_escape_string($db, $_REQUEST['se_pamount']);
		$se_tabillno = mysqli_real_escape_string($db, $_REQUEST['se_tabillno']);
		$se_tadate = mysqli_real_escape_string($db, $_REQUEST['se_tadate']);
		$se_rmaterial = mysqli_real_escape_string($db, $_REQUEST['se_rmaterial']);
		$se_mperticulars = mysqli_real_escape_string($db, $_REQUEST['se_mperticulars']);
		$se_uquantity = mysqli_real_escape_string($db, $_REQUEST['se_uquantity']);
		$se_uom = mysqli_real_escape_string($db, $_REQUEST['se_uom']);
		$se_uprice = mysqli_real_escape_string($db, $_REQUEST['se_uprice']);
		$se_totalprice = mysqli_real_escape_string($db, $_REQUEST['se_totalprice']);
		$se_rquantity = mysqli_real_escape_string($db, $_REQUEST['se_rquantity']);
		$se_rdate = mysqli_real_escape_string($db, $_REQUEST['se_rdate']);

		$db->query("UPDATE expense SET se_site='$se_site',se_employee='$se_employee',se_eamount='$se_eamount',se_pamount='$se_pamount',se_tabillno='$se_tabillno',se_tadate='$se_tadate',se_rmaterial='$se_rmaterial',se_mperticulars='$se_mperticulars',se_uquantity='$se_uquantity',se_uom='$se_uom',se_uprice='$se_uprice',se_totalprice='$se_totalprice' ,se_rquantity='$se_rquantity',se_rdate='$se_rdate' WHERE se_id = '$se_id'");
		$_SESSION['msg'] = md5('6');
	header("location: ../add-site-expense?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$se_id = $_REQUEST['se_id'];
		$db->query("DELETE from expense where `se_id`='$se_id'");
		$_SESSION['msg'] = md5('7');
		header("location: ../add-site-expense.php?msg=" . md5('7') . "");


	break; 
	default:
		$_SESSION['msg'] = md5('11');
		header("location: ../dashboard?msg=" . md5('11') . "");
	}	