<?php
session_start();
require_once '../config/config.php';
$action = $_REQUEST['submit'];
switch ($action) {
		case 'addempsalary':
		$dept = mysqli_real_escape_string($db, $_REQUEST['dept']);
		$month = mysqli_real_escape_string($db, $_REQUEST['month']);
		$year = mysqli_real_escape_string($db, $_REQUEST['year']);
		//$empcheck = mysqli_real_escape_string($db, $_REQUEST['empcheck']);
		$date = date("Y-m-d");

		$array = $_REQUEST['empcheck'];
		if(empty($array)){
	
			$_SESSION['msg'] = md5('22');
			header("location: ../add-emp-salary?msg=" . md5('22') . "");
		}else{
		foreach($array as  $emp)
		{
		//  $emp;
		$spid = intval(preg_replace('/[^0-9]+/', '', $emp), 10);

		$tdata = $db->query("SELECT * FROM  salary where es_employee = '$spid' AND es_month = '$month' AND es_year = '$year'");
		$count = mysqli_num_rows($tdata);
		if($count > 0){
			
		$_SESSION['msg'] = md5('8');
			header("location: ../add-emp-salary?msg=" . md5('8') . "");
		} else {
										
	// $tdata = $db->query("SELECT * FROM  employee where e_department = '$dept' AND e_status = '1'");
	// $value = $tdata->fetch_object();
	// $spid = $value->e_id;			
	$queryh = $db->query("SELECT * FROM holidaydetails  WHERE MONTH(hd_date) = '$month' AND DATE_FORMAT(hd_date, '%Y') = '$year' AND hd_status = '1'");
	$rowCounth = $queryh->num_rows;
	if(empty($rowCounth)){
		$rowCounth = 0;
	}
	$datam = $db->query( "SELECT * FROM `month` WHERE m_month = '$month' " );
	$valuem = $datam->fetch_object();
	 $mdays = $valuem->m_days;
	//Display present	
	
	
	// $queryp = $db->query("SELECT * FROM attendance  WHERE ea_employee = '$spid' AND MONTH(ea_date) = '$month' AND DATE_FORMAT(ea_date, '%Y') = '$year' AND ea_astatus ='P' AND ea_astatus ='L'");
	// $rowCountp = $queryp->num_rows;
	// $present = $rowCountp+$rowCounth;

	$queryp = $db->query("SELECT * FROM attendance  WHERE ea_employee = '$spid' AND MONTH(ea_date) = '$month' AND DATE_FORMAT(ea_date, '%Y') = '$year' AND ea_astatus ='P' ");

	$queryL = $db->query("SELECT * FROM attendance  WHERE ea_employee = '$spid' AND MONTH(ea_date) = '$month' AND DATE_FORMAT(ea_date, '%Y') = '$year' AND  ea_astatus ='L'");

	$rowCountp = $queryp->num_rows;
	$rowCountL = $queryL->num_rows;
	$present = $rowCountp+$rowCounth+$rowCountL;
	//$absent = $mdays-$present;
	$queryp = $db->query("SELECT * FROM employee  WHERE e_id = '$spid'");
	$valuep = $queryp->fetch_object();
	$bsalary = $valuep->e_bsalary;
	$gsalary = $valuep->e_gsalary;
	$nsalary = $valuep->e_nsalary;
	$da = $valuep->e_da;
	$hra = $valuep->e_hra;
	$allowance = $valuep->e_allowance;
	$sallowance = $valuep->e_sallowance;
//net gross salary
	$nbasic = ($bsalary/$mdays)*$present;
	$nda = ($da/$mdays)*$present;
	$nhra = ($hra/$mdays)*$present;
	$nallowance = ($allowance/$mdays)*$present;
	$nsallowance = ($sallowance/$mdays)*$present;
	$tallowance = $nda + $nhra + $nallowance + $nsallowance;
	$ngsalary = $nbasic + $tallowance ;
	//net salary                                                           
	$resulte = $db->query("SELECT * FROM salryamount");
	while($rowe = $resulte->fetch_object()){
	if(($rowe->se_type ==  'EPF')){
	$epf =  $rowe->se_percentage;
	}
	if(($rowe->se_type ==  'ESIC')){
	$esic =  $rowe->se_percentage;
	}
  }
	if(($valuep->e_jobcat) == 'P'){
		$fepf = $ngsalary *  ($epf/100);
		$fesic = $ngsalary * ($esic/100);
	}else{
		$fepf = 0;
		$fesic = 0;
	}
	$fit = $valuep->e_it;
	$fptax = $valuep->e_ptax;
	$fother = $valuep->e_other;
	$tdeduction = $fepf  + $fesic + $fit + $fptax + $fother;
	$fnsalary = $ngsalary - $tdeduction;


	$db->query("INSERT INTO `salary` (`es_id`,`es_department`, `es_employee`, `es_year`,  `es_month`, `es_days`,  `es_nbasic`,`es_nda`,`es_nhra`,`es_nallowance`,`es_nsallowance`,`es_ngsalary`,`es_fepf`,`es_fesic`,`es_fit`,`es_fptax`,`es_fother`,`es_tdeduction`,`es_fnsalary`,`es_status`, `es_cdate`) VALUES (NULL, '$dept','$spid','$year','$month','$present','$nbasic','$nda','$nhra','$nallowance','$nsallowance','$ngsalary','$fepf','$fesic','$fit','$fptax','$fother','$tdeduction','$fnsalary','1','$date')");
	$id = $db -> insert_id;
	$_SESSION['msg'] = md5('5');
	header("location: ../salary-list?dept=$dept&year=$year&month=$month&submit=getemployees&msg=" . md5('5') . "");

        
	}
}
}


	// 	$tdata = $db->query("SELECT * FROM  salary where es_employee = '$es_employee' AND es_month = '$es_month'");
	// 	$count = mysqli_num_rows($tdata);
	// 	if($count > 0){
			
	// 	$_SESSION['msg'] = md5('8');
	// 		header("location: ../add-emp-salary?e_id=$es_employee&msg=" . md5('8') . "");
	// 	} else {
	// 	$db->query("INSERT INTO `salary` (`es_id`,`es_department`, `es_employee`, `es_year`,  `es_month`, `es_days`, `es_abdays`, `es_pdaysalary`,`es_ldeduction`,`es_psalary`,`es_status`, `es_cdate`) VALUES (NULL, '$es_department','$es_employee','$es_year','$es_month','$es_days','$es_abdays','$es_pdaysalary','$es_ldeduction','$es_psalary','1','$date')");
	// 	$id = $db -> insert_id;
	// 	$_SESSION['msg'] = md5('5');
	// header("location: ../view_salary_slip?e_id=$es_employee&year=$es_year&month=$es_month&msg=" . md5('5') . "");
	// 	}
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
	default:
		$_SESSION['msg'] = md5('11');
		header("location: ../dashboard?msg=" . md5('11') . "");
	}	