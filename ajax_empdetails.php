<?php

require_once 'config/config.php';
if (isset($_POST["spID"]) && !empty($_POST["spID"])) {
	$spid=$_POST["spID"];

	//Get all state data
	$query = $db->query("SELECT * FROM employee  WHERE e_id = '$spid'");

	//Count total number of rows
	$rowCount = $query->num_rows;

	//Display states list
	$row = $query->fetch_object();
	$pro=array();
	if ($rowCount > 0) {
		$pro['es_bsalary']=$row->e_bsalary;
		$pro['es_gsalary']=$row->e_gsalary;
		$pro['es_nsalary']=$row->e_nsalary;
		$pro['es_pdaysalary']=$row->e_pdaysalary;
		echo json_encode($pro);
	}
}
?>