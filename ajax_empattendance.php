<?php

require_once 'config/config.php';
if (isset($_POST["spID"]) && !empty($_POST["spID"])) {
	$spid = $_POST["spID"];
	$spmonth = $_POST["spmonth"];
	$spyear = $_POST["spyear"];
	
	$array=array();
	//Get all state data
	$query = $db->query("SELECT * FROM attendance  WHERE ea_employee = '$spid' AND DATE_FORMAT(ea_date, '%M') = '$spmonth' AND DATE_FORMAT(ea_date, '%Y') = '$spyear'");

	//Count total number of rows
	$rowCount = $query->num_rows;
	//$rowCount = mysqli_num_rows($query)
	if(empty($rowCount)){
		$rowCount = 0;
	}
	//Display absent
	$array['absent'] = $rowCount;

	//presentdays calculate
	$datam = $db->query( "SELECT * FROM `month` WHERE m_month = '$spmonth' " );
	$valuem = $datam->fetch_object();
	$mdays = $valuem->m_days;
	$present = $mdays-$rowCount;
	$array['present'] = $present;

	//pdaysalary calculates
	
	$queryp = $db->query("SELECT * FROM employee  WHERE e_id = '$spid'");
	$valuep = $queryp->fetch_object();
	$gsalary = $valuep->e_gsalary;
	$nsalary = $valuep->e_nsalary;
	$pdaysalary = $gsalary/$mdays;
	$ldeduction = $pdaysalary*$rowCount;
	$psalary = $nsalary - $ldeduction;
	$array['pdaysalary'] = $pdaysalary;
	$array['ldeduction'] = $ldeduction;
	$array['psalary'] = $psalary;
	
	echo json_encode($array);


}
?>