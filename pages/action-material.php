<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addrematerial':
		$rm_srid = mysqli_real_escape_string($db, $_REQUEST['rm_srid']);
		$rm_mparticulars = mysqli_real_escape_string($db, $_REQUEST['rm_mparticulars']);
		$rm_quantity = mysqli_real_escape_string($db, $_REQUEST['rm_quantity']);
		$rm_uom = mysqli_real_escape_string($db, $_REQUEST['rm_uom']);
		$rm_unitprice = mysqli_real_escape_string($db, $_REQUEST['rm_unitprice']);
		$date = date("Y-m-d");
		
		$db->query("INSERT INTO `re_materials` (`rm_id`,`rm_srid`,`rm_mparticulars`, `rm_quantity`, `rm_uom`, `rm_uprice`, `rm_status`, `rm_date`) VALUES (NULL, '$rm_srid','$rm_mparticulars','$rm_quantity','$rm_uom','$rm_unitprice','1','$date')");
		$_SESSION['msg'] = md5('5');
		header("location: ../add-material?msg=" . md5('5') . "");
	
	break;
	
	case 'updaterematerial':
		$rm_id = $_REQUEST['rm_id'];
		$rm_srid = mysqli_real_escape_string($db, $_REQUEST['rm_srid']);
		$rm_mparticulars = mysqli_real_escape_string($db, $_REQUEST['rm_mparticulars']);
		$rm_quantity = mysqli_real_escape_string($db, $_REQUEST['rm_quantity']);
		$rm_uom = mysqli_real_escape_string($db, $_REQUEST['rm_uom']);
		$rm_unitprice = mysqli_real_escape_string($db, $_REQUEST['rm_unitprice']);

		$db->query("UPDATE re_materials SET rm_srid='$rm_srid',rm_mparticulars='$rm_mparticulars',rm_quantity='$rm_quantity',rm_uom='$rm_uom',rm_unitprice='$rm_unitprice' WHERE rm_id = '$rm_id'");
		$_SESSION['msg'] = md5('6');
	header("location: ../add-material?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$rm_id = $_REQUEST['rm_id'];
		$db->query("DELETE from re_material where `rm_id`='$rm_id'");
		$_SESSION['msg'] = md5('7');
		header("location: ../add-material.php?msg=" . md5('7') . "");


	break; 

	
	case 'updatemtotal':
		$rm_srid = $_REQUEST['rm_srid'];
		$sr_totalprice = mysqli_real_escape_string($db, $_REQUEST['sr_totalprice']);

		$db->query("UPDATE requistion SET sr_totalprice='$sr_totalprice' WHERE sr_id = '$rm_srid'");
		$_SESSION['msg'] = md5('6');
	header("location: ../add-material?msg=" . md5('5') . "");
	break;
	default:
		$_SESSION['msg'] = md5('11');
		header("location: ../dashboard?msg=" . md5('11') . "");
	}	