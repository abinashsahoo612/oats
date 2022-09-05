<?php
session_start();

$a_idchk = $_SESSION['a_id'];
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
	case 'present':
		$ea_id = $_REQUEST['ea_id'];
		$ea_did = $_REQUEST['ea_did'];
		$ea_date= $_REQUEST['ea_date'];
		$db->query("UPDATE attendance SET ea_astatus='P',ea_date='$ea_date' where `ea_id`='$ea_id'");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-emp-attendance.php?ea_department=$ea_did&ea_date=$ea_date&submit=getemployees&msg=" . md5('5') . "");
	break; 
	
	case 'absent':
		 $ea_id = $_REQUEST['ea_id'];
		  $ea_did = $_REQUEST['ea_did'];
	echo $ea_reason= $_REQUEST['ea_reason'];
		 $ea_date= $_REQUEST['ea_date'];
		 if($ea_reason == 'Loss Of pay'){
			$status = 'A' ;
		 } else {
			$status = 'L' ;
		 }
		 echo $status;
		$date = date("Y-m-d");
		$db->query("UPDATE attendance SET ea_astatus ='$status' , ea_reason ='$ea_reason' where ea_date='$ea_date' AND`ea_employee`='$ea_id' AND ea_department = '$ea_did'");
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-emp-attendance.php?ea_department=$ea_did&ea_date=$ea_date&msg=" . md5('5') . "");
	break; 
	
	case 'getemployees':
		$ea_did = $_REQUEST['ea_department'];
		$ea_date= $_REQUEST['ea_date'];
		$a_idchk = $_SESSION['a_id'];
		$date = date("Y-m-d");
		
		$tdata = $db->query("SELECT * FROM  attendance where ea_department = '$ea_did' AND ea_date = '$ea_date'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
		header("location: ../add-emp-attendance?ea_date=$ea_date&ea_department=$ea_did&msg=" . md5('8') . "");
	} else {
		$tdata = $db->query("SELECT * FROM  employee where e_department = '$ea_did' AND e_status = 1");
		while ($value = $tdata->fetch_object()) {
		 $ea_id = $value->e_id;

		$tdatah = $db->query("SELECT * FROM  holidaydetails where hd_date = '$ea_date'");
		$counth = mysqli_num_rows($tdatah);
			
		if( date('l', strtotime($ea_date)) == 'Sunday'){
		$status = 'O';
		$reason = 'Sunday';
		} else if($counth > 0){
		$valueh = $tdatah->fetch_object();
		$name = $valueh->hd_name;
		
		$sqls = $db->query("select * from holiday where h_id = '$name' ");
		$querys = $sqls->fetch_object();
		$status = 'H';
		$reason = $querys->h_name;
		} else {
			$status = 'P';
			$reason = '';
		}

		$db->query("INSERT INTO attendance (`ea_id`,`ea_department`, `ea_employee`, `ea_date`, `ea_astatus`,`ea_reason`, `ea_user`,`ea_status`, `ea_cdate`) VALUES (NULL,'$ea_did', '$ea_id','$ea_date','$status','$reason','$a_idchk', '2','$date')");
		}
		$_SESSION['msg'] = md5('5');
		header("Location: ../add-emp-attendance.php?ea_date=$ea_date&ea_department=$ea_did&msg=" . md5('5') . "");
	}
	break; 

	case 'submitattnd':
		$a_idchk = $_SESSION['a_id'];
		//$ea_id = $_REQUEST['ea_id'];
		$ea_did = $_REQUEST['ea_did'];
		 $ea_date= $_REQUEST['ea_date'];
		$date = date("Y-m-d");
		
		$tdata = $db->query("SELECT * FROM  finalattendance where fa_department = '$ea_did' AND fa_date = '$ea_date' AND fa_user='$a_idchk'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
		header("location: ../add-emp-attendance?ea_date=$ea_date&ea_department=$ea_did&msg=" . md5('8') . "");
	} else {
		$db->query("INSERT INTO finalattendance (`fa_id`,`fa_department`,  `fa_date`, `fa_user`,`fa_status`, `fa_cdate`) VALUES (NULL,'$ea_did','$ea_date','$a_idchk', '1','$date')");
		
		$db->query("UPDATE attendance SET ea_status ='1'  where ea_date='$ea_date' AND ea_department = '$ea_did'");

		$_SESSION['msg'] = md5('5');
		header("Location: ../add-emp-attendance.php?ea_department=$ea_did&ea_date=$ea_date&msg=" . md5('5') . "");
	}
	break; 

	default:
		$_SESSION['msg'] = md5('11');
		header("Location: ../dashboard?msg=" . md5('11') . "");
	}	