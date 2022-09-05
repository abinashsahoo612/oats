<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
	
	case 'updatesalarysetup':
		$e_id = $_REQUEST['e_id'];
		$e_bsalary = mysqli_real_escape_string($db, $_REQUEST['e_bsalary']);
		$e_da = mysqli_real_escape_string($db, $_REQUEST['e_da']);
		$e_hra = mysqli_real_escape_string($db, $_REQUEST['e_hra']);
		$e_allowance = mysqli_real_escape_string($db, $_REQUEST['e_allowance']);
		$e_sallowance = mysqli_real_escape_string($db, $_REQUEST['e_sallowance']);
		$e_gsalary = mysqli_real_escape_string($db, $_REQUEST['e_gsalary']);
		$e_epfamount = mysqli_real_escape_string($db, $_REQUEST['e_epfamount']);
		$e_esicamount = mysqli_real_escape_string($db, $_REQUEST['e_esicamount']);
		$e_it = mysqli_real_escape_string($db, $_REQUEST['e_it']);
		$e_ptax = mysqli_real_escape_string($db, $_REQUEST['e_ptax']);
		$e_other = mysqli_real_escape_string($db, $_REQUEST['e_other']);
		$e_nsalary = mysqli_real_escape_string($db, $_REQUEST['e_nsalary']);
		$e_pdaysalary = mysqli_real_escape_string($db, $_REQUEST['e_pdaysalary']);
		
		$db->query("UPDATE employee SET e_bsalary='$e_bsalary',e_da='$e_da',e_hra='$e_hra',e_allowance='$e_allowance',e_sallowance='$e_sallowance',e_gsalary='$e_gsalary',e_epfamount='$e_epfamount',e_esicamount='$e_esicamount',e_it='$e_it',e_ptax='$e_ptax',e_other='$e_other',e_nsalary='$e_nsalary',e_pdaysalary='$e_pdaysalary' WHERE e_id = '$e_id'");
		$_SESSION['msg'] = md5('6');
	header("location: ../add-salary-setup?e_id=$e_id&msg=" . md5('6') . "");
	break;
	default:
		$_SESSION['msg'] = md5('11');
		header("location: ../dashboard?msg=" . md5('11') . "");
	}	