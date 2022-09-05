<?php

error_reporting(E_ALL | E_DEPRECATED | E_STRICT);
/*
 * set default time-zone to confirm the timezone
 * else it will show an error that system time is not reliable
 * Change it as per your timezone
 */
date_default_timezone_set('Asia/Kolkata');

/*
 * set maximum script execution time to overcome
 * timeout situations
 * I have set it for 5 minutes, i.e. 5 mins * 60 seconds,
 * But dont use unlimited or too much time as it may cause
 * too much server load and even breakdown
 */
set_time_limit(10 * 60);
define('HOST', $_SERVER['SERVER_NAME']);

$base = "oats";
$server = "localhost";
$user = "root";
$pass = "";
// $pass = "DCLG(o0t70q]";
//Open a new connection to the MySQL server
$db = new mysqli($server, $user, $pass, $base);
//Output any connection error
if ($db->connect_error) {
  // die('Error : (' . $db->connect_errno . ') ' . $db->connect_error);
  die('Error : (' . header("Location: ../404?msg=" . md5('5') . "") . ') ' . $db->connect_error);
}

function track($message,$errorLocation='',$file='track.txt'){
	$fp = fopen($file,'a');
	fwrite($fp, "\n".date('Y-m-d H:i:s:u').' at '.$errorLocation.' :: '.((is_string($message))?($message):(var_export($message,TRUE))));
	fclose($fp);
}
