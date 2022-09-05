<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addemployee':
		$e_circle = mysqli_real_escape_string($db, $_REQUEST['e_circle']);
		$e_location = mysqli_real_escape_string($db, $_REQUEST['e_location']);
		$e_department = mysqli_real_escape_string($db, $_REQUEST['e_department']);
		$e_name = mysqli_real_escape_string($db, $_REQUEST['e_name']);
		$e_fname = mysqli_real_escape_string($db, $_REQUEST['e_fname']);
		$e_gender = mysqli_real_escape_string($db, $_REQUEST['e_gender']);
		$e_bgroup = mysqli_real_escape_string($db, $_REQUEST['e_bgroup']);
		$e_contact = mysqli_real_escape_string($db, $_REQUEST['e_contact']);
		$e_addr = mysqli_real_escape_string($db, $_REQUEST['e_addr']);
		$e_code = mysqli_real_escape_string($db, $_REQUEST['e_code']);
		$e_designation = mysqli_real_escape_string($db, $_REQUEST['e_designation']);
		$e_jobcat = mysqli_real_escape_string($db, $_REQUEST['e_jobcat']);
		$e_bdetails = mysqli_real_escape_string($db, $_REQUEST['e_bdetails']);
		$e_esicno = mysqli_real_escape_string($db, $_REQUEST['e_esicno']);
		$e_epf = mysqli_real_escape_string($db, $_REQUEST['e_epf']);
		$e_dob = mysqli_real_escape_string($db, $_REQUEST['e_dob']);
		$e_doj = mysqli_real_escape_string($db, $_REQUEST['e_doj']);
		$e_acontact = mysqli_real_escape_string($db, $_REQUEST['e_acontact']);
		$e_email = mysqli_real_escape_string($db, $_REQUEST['e_email']);
		$e_paddr = mysqli_real_escape_string($db, $_REQUEST['e_paddr']);
		$date = date("Y-m-d");
		$db->query("INSERT INTO `employee` (`e_id`,`e_circle`, `e_location`, `e_department`, `e_name`, `e_fname`, `e_gender`, `e_bgroup`, `e_contact`, `e_addr`, `e_code`, `e_designation`, `e_jobcat`, `e_bdetails`, `e_esicno`, `e_epf`, `e_dob`, `e_doj`, `e_bsalary`, `e_allowance`, `e_gsalary`,  `e_da`, `e_hra`, `e_sallowance`, `e_epfamount`, `e_esicamount`, `e_it`, `e_ptax`,`e_other`, `e_nsalary`, `e_pdaysalary`,`e_acontact`, `e_email`, `e_paddr`,`e_status`, `e_cdate`) VALUES (NULL, '$e_circle','$e_location','$e_department','$e_name','$e_fname','$e_gender','$e_bgroup','$e_contact','$e_addr','$e_code','$e_designation','$e_jobcat','$e_bdetails','$e_esicno','$e_epf','$e_dob','$e_doj','','','','','','','','','','','','','','$e_acontact','$e_email','$e_paddr','1','$date')");
		$_SESSION['msg'] = md5('5');
		header("location: ../add-employee?msg=" . md5('5') . "");
	break;
	
	case 'updateemployee':
		$e_id = $_REQUEST['e_id'];
		$e_circle = mysqli_real_escape_string($db, $_REQUEST['e_circle']);
		$e_location = mysqli_real_escape_string($db, $_REQUEST['e_location']);
		$e_department = mysqli_real_escape_string($db, $_REQUEST['e_department']);
		$e_name = mysqli_real_escape_string($db, $_REQUEST['e_name']);
		$e_fname = mysqli_real_escape_string($db, $_REQUEST['e_fname']);
		$e_gender = mysqli_real_escape_string($db, $_REQUEST['e_gender']);
		$e_bgroup = mysqli_real_escape_string($db, $_REQUEST['e_bgroup']);
		$e_contact = mysqli_real_escape_string($db, $_REQUEST['e_contact']);
		$e_addr = mysqli_real_escape_string($db, $_REQUEST['e_addr']);
		$e_code = mysqli_real_escape_string($db, $_REQUEST['e_code']);
		$e_designation = mysqli_real_escape_string($db, $_REQUEST['e_designation']);
		$e_jobcat = mysqli_real_escape_string($db, $_REQUEST['e_jobcat']);
		$e_bdetails = mysqli_real_escape_string($db, $_REQUEST['e_bdetails']);
		$e_esicno = mysqli_real_escape_string($db, $_REQUEST['e_esicno']);
		$e_epf = mysqli_real_escape_string($db, $_REQUEST['e_epf']);
		$e_dob = mysqli_real_escape_string($db, $_REQUEST['e_dob']);
		$e_doj = mysqli_real_escape_string($db, $_REQUEST['e_doj']);
		
		$db->query("UPDATE employee SET e_circle='$e_circle',e_location='$e_location',e_department='$e_department',e_name='$e_name',e_fname='$e_fname',e_gender='$e_gender',e_bgroup='$e_bgroup',e_contact='$e_contact',e_addr='$e_addr',e_code='$e_code',e_designation='$e_designation',e_jobcat='$e_jobcat',e_bdetails='$e_bdetails',e_esicno='$e_esicno',e_epf='$e_epf',e_dob='$e_dob',e_doj='$e_doj' WHERE e_id = '$e_id'");
		$_SESSION['msg'] = md5('6');
	header("location: ../add-employee?msg=" . md5('5') . "");
	break;
	 case 'delete':
		$e_id = $_REQUEST['e_id'];
		$db->query("DELETE from employee where `e_id`='$e_id'");
		$_SESSION['msg'] = md5('7');
		header("location: ../add-employee.php?msg=" . md5('7') . "");


	break; 
	
	case 'Disable':
		$e_id = $_REQUEST[ 'e_id' ];
		$db->query( "UPDATE `employee` SET e_status = '2' WHERE e_id = '$e_id'" );
		$_SESSION[ 'errormsg' ] = 'Authority disabled';
		$_SESSION[ 'errorValue' ] = 'success';
		header( "Location: ../add-employee?msg=" . md5( '5' ) . "" );
		break;
	case 'Enable':
		$e_id = $_REQUEST[ 'e_id' ];
		$db->query( "UPDATE `employee` SET e_status = '1' WHERE e_id = '$e_id'" );
		$_SESSION[ 'errormsg' ] = 'Authority Enabled';
		$_SESSION[ 'errorValue' ] = 'success';
		header( "Location: ../add-employee?msg=" . md5( '5' ) . "" );
		break;

		
	case 'resign':
		$e_id = $_REQUEST[ 'e_id' ];
		$r_date = mysqli_real_escape_string($db, $_REQUEST['r_date']);
		$date = date("Y-m-d");
		$db->query( "UPDATE `employee` SET e_status = '2' WHERE e_id = '$e_id'" );
		$db->query("INSERT INTO `jobstatus` (`j_id`, `j_eid`,`j_date`, `j_status`, `j_cdate`) VALUES (NULL,'$e_id', '$r_date', '1','$date')");

		$_SESSION[ 'errormsg' ] = 'Authority disabled';
		$_SESSION[ 'errorValue' ] = 'success';
		header( "Location: ../add-employee?msg=" . md5( '5' ) . "" );
		break;
	case 'rejoin':
		$e_id = $_REQUEST[ 'e_id' ];
		$r_date = mysqli_real_escape_string($db, $_REQUEST['r_date']);
		$date = date("Y-m-d");
		$db->query( "UPDATE `employee` SET e_status = '1' WHERE e_id = '$e_id'" );
		$db->query("INSERT INTO `jobstatus` (`j_id`, `j_eid`,`j_date`, `j_status`, `j_cdate`) VALUES (NULL,'$e_id', '$r_date', '2','$date')");
		$_SESSION[ 'errormsg' ] = 'Authority Enabled';
		$_SESSION[ 'errorValue' ] = 'success';
		header( "Location: ../add-employee?msg=" . md5( '5' ) . "" );
		break;

		
	default:
		$_SESSION['msg'] = md5('11');
		header("location: ../dashboard?msg=" . md5('11') . "");
	}	