<?php

require_once 'config/config.php';
if (isset($_POST["pid"]) && !empty($_POST["pid"])) {
	$siteID=$_POST["pid"];
	//Get all state data
    $pro=array();
	
	$query = $db->query("SELECT * FROM `site`  WHERE s_siteid = '$siteID'");

	//Count total number of rows
	$rowCount = $query->num_rows;

	//Display states list
	$row = $query->fetch_object();
    $id =$row->s_sitename;
    //Display sub scopes
	$querys = $db->query("SELECT * FROM `requisition` JOIN `subscope` ON requisition.sr_subscope =  subscope.sc_id WHERE sr_site = '$id'");
    $rows = $querys->fetch_object();
    $pro['subscope'] =  $rows ->sc_name;

	$pro['expence'] =  $rows ->sr_rapproval;

	echo json_encode($pro);
}
?>