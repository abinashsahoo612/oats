<?php
session_start();
require_once 'config/config.php';
require_once 'config/helper.php';
if(isset($_POST["pid"]) && !empty($_POST["pid"])){

    
	$pro=array();
    $query = $db->query("SELECT * FROM requisition WHERE sr_site = ".$_POST['pid']."");
    
      $row = $query->fetch_object();
      $emp = $row->sr_employee;

      $querye = $db->query("SELECT * FROM employee WHERE e_id = '$emp'");
      $rowe = $querye->fetch_object();
      $pro['ename'] = $rowe->e_name;
      $pro['paidamount'] = $row->sr_rapproval;

      echo json_encode($pro);

    
}