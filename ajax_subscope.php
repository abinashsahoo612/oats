<?php
session_start();
require_once 'config/config.php';
require_once 'config/helper.php';
if(isset($_POST["pid"]) && !empty($_POST["pid"])){
   $id =  $_POST['pid'];
    $pro=array();
    //Get site scope
    $query = $db->query("SELECT * FROM `site` WHERE s_siteid = '$id' ");
    $row = $query->fetch_object();

    
    $scope = $row->s_scope;

    
    echo '<option value="">Select Sub Scope</option>';
    //Display sub scopes    
    foreach (explode( ',', $scope ) as $perm ){
    $querys = $db->query("SELECT * FROM subscope WHERE sc_scope = '$perm' ");
    if($querys->num_rows > 0){
        while($rows = $querys->fetch_object()){ 
            echo '<option value="'.$rows->sc_id.'">'.$rows->sc_name.'</option>';
        }
    }
}

}