<?php
session_start();
require_once 'config/config.php';
require_once 'config/helper.php';
if(isset($_POST["pid"]) && !empty($_POST["pid"])){
    //Get all state data
    $query = $db->query("SELECT * FROM employee WHERE e_department = ".$_POST['pid']." ORDER BY e_name ASC");
    
    //Display states list
    if($query->num_rows > 0){
        echo '<option value="">Select Employee</option>';
        while($row = $query->fetch_object()){ 
            echo '<option value="'.$row->e_id.'">'.$row->e_name.'</option>';
        }
    }else{
        echo '<option value="">Employee not available</option>';
    }
}