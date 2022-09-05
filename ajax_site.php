<?php

require_once 'config/config.php';
if (isset($_POST["pid"]) && !empty($_POST["pid"])) {
	$siteID=$_POST["pid"];


    $pro=array();
	

	//Get all state data
	$query = $db->query("SELECT * FROM `site`  WHERE s_siteid = '$siteID'");

	//Count total number of rows
	$rowCount = $query->num_rows;

	//Display states list
	$row = $query->fetch_object();
    $pro['id'] = $id =$row->s_id;
	if ($rowCount > 0) {
		$pro['site'] = $row->s_sitename;
	}


    $scope = $row->s_scope;

    
    foreach ( explode( ',', $scope ) as $perm ) { 
        $s_id = $perm;
            $sqld = $db->query("select * from scope WHERE s_id = '$s_id'");
            if((mysqli_num_rows($sqld)) > 0) {
            $queryd = $sqld->fetch_object();
            $scopes = $queryd->s_name;
            $pro['scope'] = $scopes.','; 
            }
        
        }	
    //Display sub scopes
	// $querys = $db->query("SELECT * FROM `requisition` JOIN `subscope` ON requisition.sr_subscope =  subscope.sc_id WHERE sr_site = '$id'");
    // $rows = $querys->fetch_object();
    // $pro['subscope'] = $rows ->sc_name;
      

echo json_encode($pro);


}
?>