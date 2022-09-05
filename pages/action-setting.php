<?php 	
	session_start();
	require_once '../config/config.php';
	$action = $_REQUEST['submit'];
	$img_id = $_REQUEST['tempprod_id'];
	$cm_n = mysqli_real_escape_string($db, $_REQUEST['cm_n']);
	$cm_a = mysqli_real_escape_string($db, $_REQUEST['cm_a']);
	$cm_p = mysqli_real_escape_string($db, $_REQUEST['cm_p']);
	$cm_g = mysqli_real_escape_string($db, $_REQUEST['cm_g']);
	$cm_e = mysqli_real_escape_string($db, $_REQUEST['cm_e']);
	$db->query("UPDATE admin SET a_company='$cm_n', a_address='$cm_a',a_phone ='$cm_p',a_gst ='$cm_g', a_email='$cm_e' WHERE  a_id = '$img_id'");
    
	if (!empty($_FILES["logo_two"]["name"])) {	
		$photo = $_FILES['logo_two']['name'];
		include_once 'photocrop.php';
		
		//phpto upload
		if ($_FILES["logo_two"]["size"] > 0) {
			$photo = $_FILES['logo_two']['name'];
			$random_digit = rand(0000, 9999) . time();
			$new_p_photo = $random_digit . $photo;
			$allowedExts = array("gif", "jpeg", "jpg", "JPEG", "JPG", "png", "PNG");
			$temp = explode(".", $_FILES["logo_two"]["name"]);
			$extension = end($temp);
			
			if ((($_FILES["logo_two"]["type"] == "image/gif") || ($_FILES["logo_two"]["type"] == "image/jpeg") || ($_FILES["logo_two"]["type"] == "image/jpg") || ($_FILES["logo_two"]["type"] == "image/JPEG") || ($_FILES["logo_two"]["type"] == "image/JPG") || ($_FILES["logo_two"]["type"] == "image/pjpeg") || ($_FILES["logo_two"]["type"] == "image/x-png") || ($_FILES["logo_two"]["type"] == "image/png") || ($_FILES["logo_two"]["type"] == "image/PNG")) && in_array($extension, $allowedExts)) {
				if ($_FILES["logo_two"]["error"] > 0) {
					echo "Return Code: " . $_FILES["logo_two"]["error"] . "<br>";
					} else {
					$p_temp = resizeImage($_FILES['logo_two']['tmp_name'], 396, 90, $photo);
					$imgfile = "upload/" . $new_p_photo;
					move_uploaded_file($_FILES["logo_two"]["tmp_name"], $imgfile);
					$data = $db->query("SELECT 	a_logo FROM admin WHERE a_id = '$img_id'");
					$value = $data->fetch_object();
					//unlink($value->a_logo); // remove files	
					$db->query("UPDATE admin SET a_logo = '$imgfile' WHERE a_id = '$img_id'");
				}
			}
		}
	}
	$_SESSION['msg'] = md5('6');
	header("Location: ../add-settings?msg=" . md5('5') . "");
