<?php
session_start();
require_once 'config/config.php';
require_once 'config/helper.php';
if(isset($_POST["pid"]) && !empty($_POST["pid"])){
    //Get all state data
    $query = $db->query("SELECT * FROM location WHERE l_circle = ".$_POST['pid']." ORDER BY l_name ASC");
    
    //Display states list
    if($query->num_rows > 0){
        echo '<option value="">Select Location</option>';
        while($row = $query->fetch_object()){ 
            echo '<option value="'.$row->l_id.'">'.$row->l_name.'</option>';
        }
    }else{
        echo '<option value="">Location not available</option>';
    }
}