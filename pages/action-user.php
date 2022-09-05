<?php

session_start();
require_once '../config/config.php';
require_once '../config/helper.php';
$action = $_REQUEST[ 'submit' ];
switch ( $action ) {
	case 'addUser':
		$a_email = mysqli_real_escape_string( $db, $_POST[ 'a_email' ] );
		$query = $db->query( "SELECT a_email FROM `admin` WHERE a_email = '$a_email'" );
		$num_rows = $query->num_rows;
		if ( $num_rows > 0 ) {
			$_SESSION[ 'msg' ] = md5( '8' );
			header( "location: add-user?msg=" . md5( '8' ) . "" );
		} else {

			$a_name = strtoupper( mysqli_real_escape_string( $db, $_POST[ 'a_name' ] ) );

			$a_dob = date( "Y-m-d H:i:s" );
			$a_doj = date( "Y-m-d H:i:s" );

			$a_phone = $_POST[ 'a_phone' ];

			if ( !empty( $_POST[ 'a_address' ] ) ) {
				$a_address = mysqli_real_escape_string( $db, $_POST[ 'a_address' ] );
			} else {
				$a_address = '';
			}
			if ( !empty( $_POST[ 'a_desig' ] ) ) {
				$a_desig = mysqli_real_escape_string( $db, $_POST[ 'a_desig' ] );
			} else {
				$a_desig = '';
			}

			$a_date = date( "Y-m-d H:i:s" );
			$a_vpwd = 'h' . date( "ymd", strtotime( $a_dob ) );
			$a_password = md5( $a_vpwd );
			$a_dept = mysqli_real_escape_string( $db, $_POST[ 'a_dept' ] );
			// $a_usertype = $_REQUEST['a_usertype'];
			if ( !empty( $_POST[ 'a_pagepermission' ] ) ) {
				$a_pagepermission = implode( ",", $_POST[ 'a_pagepermission' ] );
			} else {
				$a_pagepermission = '';
			}


			$db->query( "INSERT INTO `admin` (`a_id`,  `a_email`, `a_password`, `a_vpwd`, `a_name`, `a_desig`, `a_phone`, `a_address`, `a_company`, `a_usertype`, `a_status`, `a_dob`, `a_doj`, `a_pagepermission`,`a_dept`, `a_date`) VALUES (NULL, '$a_email', '$a_password', '$a_vpwd', '$a_name', '$a_desig', '$a_phone', '$a_address', 'OATS', '2', '1', '$a_dob', '$a_doj', '$a_pagepermission', '$a_dept','$a_date')" );
			$lid = $db->insert_id;
			$y = date( 'y' );
			$jmd = date( "md", strtotime( $a_doj ) );
			$fl = substr( $a_name, 0, 1 );
			$a_code = 'A' . $y . $jmd . $fl; // after adding the top detail last inserted id
			$db->query( "UPDATE `admin` SET a_code = '$a_code' WHERE a_id = '$lid'" );

			$_SESSION[ 'errormsg' ] = 'Authority user added.';
			$_SESSION[ 'errorValue' ] = 'success';
			header( "Location: ../add-user?msg=" . md5( '5' ) . "" );
		}

		break;
	case 'updateUSER':
		$a_id = $_POST[ 'a_id' ];
		$a_email = mysqli_real_escape_string( $db, $_POST[ 'a_email' ] );
		$a_dept = mysqli_real_escape_string( $db, $_POST[ 'a_dept' ] );
		$a_name = strtoupper( mysqli_real_escape_string( $db, $_POST[ 'a_name' ] ) );
		$a_dob = date( "Y-m-d H:i:s" );
		$a_doj = date( "Y-m-d H:i:s" );
		$a_phone = $_POST[ 'a_phone' ];
		if ( !empty( $_POST[ 'a_desig' ] ) ) {
			$a_desig = mysqli_real_escape_string( $db, $_POST[ 'a_desig' ] );
		} else {
			$a_desig = '';
		}

		if ( !empty( $_POST[ 'a_address' ] ) ) {
			$a_address = mysqli_real_escape_string( $db, $_POST[ 'a_address' ] );
		} else {
			$a_address = '';
		}
		$db->query( "UPDATE `admin` SET a_name='$a_name', a_desig='$a_desig', a_phone='$a_phone', a_address='$a_address',a_dept='$a_dept'  WHERE a_id = '$a_id'" );
		
		$_SESSION[ 'errormsg' ] = 'Data updated';
		$_SESSION[ 'errorValue' ] = 'success';
		header( "Location: ../add-user?msg=" . md5( '5' ) . "" );
		break;
	case 'UserPermission':
		$a_id = $_POST[ 'a_id' ];
		if ( !empty( $_POST[ 'a_pagepermission' ] ) ) {
			$a_pagepermission = implode( ",", $_POST[ 'a_pagepermission' ] );
		} else {
			$a_pagepermission = '';
		}
		$db->query( "UPDATE `admin` SET a_pagepermission = '$a_pagepermission' WHERE a_id = '$a_id'" );
		$_SESSION[ 'errormsg' ] = 'Permission updated';
		$_SESSION[ 'errorValue' ] = 'success';
		header( "Location: ../add-user?msg=" . md5( '5' ) . "" );
		break;
	case 'Disable':
		$a_id = $_REQUEST[ 'a_id' ];
		$db->query( "UPDATE `admin` SET a_status = '2' WHERE a_id = '$a_id'" );
		$_SESSION[ 'errormsg' ] = 'Authority disabled';
		$_SESSION[ 'errorValue' ] = 'success';
		header( "Location: ../add-user?msg=" . md5( '5' ) . "" );
		break;
	case 'Enable':
		$a_id = $_REQUEST[ 'a_id' ];
		$db->query( "UPDATE `admin` SET a_status = '1' WHERE a_id = '$a_id'" );
		$_SESSION[ 'errormsg' ] = 'Authority Enabled';
		$_SESSION[ 'errorValue' ] = 'success';
		header( "Location: ../add-user?msg=" . md5( '5' ) . "" );
		break;
	case 'ChangeUserPwd':
		$a_id = $_REQUEST[ 'a_id' ];
		$a_pwd = md5( $_REQUEST[ 'a_pwd' ] );
		$confirm_a_pwd = md5( $_REQUEST[ 'confirm_a_pwd' ] );
		$a_vpwd = $_REQUEST[ 'a_pwd' ];
		if ( $a_pwd !== $confirm_a_pwd ) {
			$db->close();
			$_SESSION[ 'errormsg' ] = 'Password does not same.';
			$_SESSION[ 'errorValue' ] = 'warning';
			header( "Location: ../add-user?msg=" . md5( '10' ) . "" );
		} else {
			$db->query( "UPDATE admin SET a_password='$a_pwd', a_vpwd='$a_vpwd'  WHERE a_id = '$a_id'" );
			$db->close();
			$_SESSION[ 'errormsg' ] = 'Password Changed';
			$_SESSION[ 'errorValue' ] = 'success';
			header( "Location: ../add-user?msg=" . md5( '5' ) . "" );
		}

		break;

	default:
		$_SESSION[ 'errormsg' ] = 'Invalid page access.';
		$_SESSION[ 'errorValue' ] = 'warning';
		header( "Location: ../404?msg=" . md5( '11' ) . "" );
}