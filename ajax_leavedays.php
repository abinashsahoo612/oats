<?php
session_start();
require_once 'config/config.php';
require_once 'config/helper.php';
if(isset($_POST["pid"]) && !empty($_POST["pid"])){
   $id =  $_POST['pid'];
   $date =  $_POST['date'];
   $emp =  $_POST['emp'];
   $daten=strtotime($date);
$year=date("Y",$daten);
    //Get site scope
    $query = $db->query("SELECT * FROM `attendance` WHERE DATE_FORMAT(ea_date, '%Y') = '$year' AND ea_astatus = '$id' AND ea_employee = '$emp' ");
    $row = $query->fetch_object();
    $count = mysqli_num_rows($query);
    
    $queryr = $db->query("SELECT * FROM `reason` WHERE  r_type = '$id' ");
    $rowr = $queryr->fetch_object();
    $days = $rowr->r_days;
   echo $rdays =  $days -  $count;

    


}