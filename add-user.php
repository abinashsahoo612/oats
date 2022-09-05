<?php
session_start();
require_once 'config/config.php';
require_once 'config/helper.php';

if (!empty($_SESSION['OATS'])) {
	if ($_SESSION['OATS'] != session_id() && $_SESSION['logintype'] != 'Admin') {
		header('Location: index');
		exit;
	}
	} else {
	header('Location: index');
	exit;
}
$logintype = $_SESSION['logintype'];
$a_idchk = $_SESSION['a_id'];
$atype = $_SESSION['a_usertype'];
ob_start("ob_html_compress");

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>User Section</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
			th,td { text-align:center;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">User Section <small class="pull-right"><a href="#demoADDuser" class="btn btn-primary btn-sm" data-toggle="collapse" id="AddUser"><i class="fa fa-plus" aria-hidden="true"></i> Add User</a></small></h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
			<!-- /.row -->
			<div class="row">

			<div id="demoADDuser" class="collapse">
				<?php
				if ( !empty( $_REQUEST[ 'a_id' ] ) ) {
					$a_id = $_REQUEST[ 'a_id' ];
					$results = $db->query( "SELECT * FROM `admin` WHERE a_id = '$a_id'" );
					$row = $results->fetch_object();
				}
				?>
				<form action="pages/action-user.php" enctype="multipart/form-data" method="post" autocomplete="off">
					<div class="col-lg-6 col-md-6 col-xs-12">  <div class="form-group">
				<label>Select Department </label>
				<select name="a_dept" id="a_dept" class="form-control input-sm" required>
					<option value="">Select Department</option>
					<?php
						$sql = $db->query("select * from department ");
						if (mysqli_num_rows($sql) > 0) {
							while ($query = $sql->fetch_object()) {
					?>
							<option  value="<?php echo $query->d_id; ?>"><?php echo $query->d_name; ?></option>
							<?php
							}
						}
					?>
					
				</select>
			</div>
						<div class="form-group">
							<label> Name: <sup>*</sup></label>
							<input type="text" class="form-control input-sm" name="a_name" value="<?php
													if (!empty($_REQUEST['a_id'])) {
														echo $row->a_name;
													}
													?>" placeholder="Employee Name" required>
						</div>
						<div class="form-group">
							<label> Designation:</label>
								<input type="text" class="form-control input-sm" name="a_desig" value="<?php
								if (!empty($_REQUEST['a_id'])) {
									echo $row->a_desig;
								}
								?>" placeholder="Authority Designation">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-xs-12">
						<div class="form-group">
							<label>Email: <sup>*</sup></label>
							<input type="email" class="form-control input-sm" name="a_email" value="<?php
								if (!empty($_REQUEST['a_id'])) {
									echo $row->a_email;
								}
								?>" placeholder="Employee Email ID" required <?php if (!empty($_REQUEST[ 'a_id'])) { echo 'readonly'; } ?> >
						</div>
						<div class="form-group">
							<label> Contact: <sup>*</sup></label>
							<input type="number" class="form-control input-sm" name="a_phone" value="<?php
              if (!empty($_REQUEST['a_id'])) {
                echo $row->a_phone;
              }
              ?>" placeholder="Mobile No." required>
						</div>
						<div class="form-group">
							<label>Permanent Address: <sup>*</sup></label>
							<input type="text" class="form-control input-sm" name="a_address" value="<?php
              if (!empty($_REQUEST['a_id'])) {
                echo $row->a_address;
              }
              ?>" placeholder="Permanent Address" required>
						</div>
						<div class="form-group"> <br>
							<input type="submit" name="submitf" id="submit" value="Submit" class="btn btn-success" onClick="return confirm('Are you sure want to SUBMIT')">

							<?php if (!empty($_REQUEST['a_id'])) { ?>
							<input type="hidden" name="submit" value="updateUSER"/>
							<input type="hidden" name="a_id" value="<?php echo $row->a_id; ?>"/>
							<?php } else { ?>
							<input type="hidden" name="submit" value="addUser"/>
							<?php } ?>
						</div>
					</div>
				</form>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-12 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title"><strong>All User List</strong></h2>
					</div>
					<div class="panel-body">
						<div class="dataTable_wrapper">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th class="no-sort">Sl.</th>
										<th class="no-sort">Action</th>
										<th> Department</th>
										<th> Name</th>
										<th> Contact</th>
										<th> Designation</th>
										<th> User Id</th>
										<th> PWD</th>
										<th> Permission</th>
										<th>Status</th>

									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM admin WHERE a_id!= '1' ORDER BY a_name ASC" );
									while ( $value = $data->fetch_object() ) {
										$sl++;
										?>
									<tr <?php if ($value->a_status === '2') { echo 'style="text-decoration: line-through; color: #999;"'; } ?>>
										<td>
											<?= $sl; ?>
										</td>
										<td><a href="?a_id=<?= $value->a_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
											<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-id=<?= $value->a_id; ?> data-target="#myModal" title="Change Password"><i class="fa fa-key" aria-hidden="true"></i></button>
										</td>
										<td>
											<?= $value->a_dept; ?><br>
										</td>
										<td>
											<?= $value->a_name; ?><br>
										</td>
										<td>
											<?= $value->a_email; ?>
											<br>
											<?= $value->a_phone; ?><br>
											<?= $value->a_address; ?>
										</td>
										<td>
											<?= (!empty($value->a_desig))?($value->a_desig):('NA'); ?>
										</td>

										<td>
											<?= $value->a_email; ?>
										</td>
										<td>
											<?= $value->a_vpwd; ?>
										</td>
							
										<td><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-id=<?= $value->a_id; ?> data-target="#myModalPermission" title="Give Permission"><i class="fa fa-key" aria-hidden="true"></i> Permission</button>
										</td>
										<td>
											<?php if ($value->a_status == '1') { ?> Active &nbsp; <a href="pages/action-user?a_id=<?= $value->a_id; ?>&submit=Disable" onClick="return confirm('Are You Sure want to Disable??')" class="btn btn-warning btn-xs" title="click to Disable"> <span class="glyphicon glyphicon-refresh"></span></a>
											<?php } else { ?> Disable <a href="pages/action-user?a_id=<?= $value->a_id; ?>&submit=Enable" onClick="return confirm('Are You Sure want to Enable??')" class="btn btn-primary btn-xs" title="click to Enable"> <span class="glyphicon glyphicon-refresh"></span></a>
											<?php } ?>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<div class="modal fade" id="myModalPermission" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Permission</h4>
										</div>
										<div class="modal-body">
											<div class="fetched-data-ppay"></div>
											<!-- fetch data through ajax from -->
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Change Password</h4>
										</div>
										<div class="modal-body">
											<div class="fetched-data-cpay"></div>
											<!-- fetch data through ajax from -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		
		</div>
	<?php include_once 'footer.php'; ?>	
		<script type="text/javascript">
			$(document).ready(function () {
				var FromDate = $('input[name="FromDate"]');
				var ToDate = $('input[name="ToDate"]');
				var container = $('#row form').length > 0 ? $('#row form').parent() : "body";
				var options = {
					format: 'yyyy-mm-dd',
					container: container,
					todayHighlight: true,
					autoclose: true,
					startDate: '01.01.2000',
				};
				FromDate.datepicker(options);
				ToDate.datepicker(options);
			});
			
		$( document ).ready( function () {
			$( '#myModalPermission' ).on( 'show.bs.modal', function ( e ) {
				var rowid = $( e.relatedTarget ).data( 'id' );
				$.ajax( {
					type: 'post',
					url: 'fetch_permission.php', //Here you will fetch records 
					data: 'rowid=' + rowid, //Pass $id
					success: function ( data ) {
						$( '.fetched-data-ppay' ).html( data ); //Show fetched data from database
					}
				} );
			} );
		} );
		
		$( document ).ready( function () {
			$( '#myModal' ).on( 'show.bs.modal', function ( e ) {
				var rowid = $( e.relatedTarget ).data( 'id' );
				$.ajax( {
					type: 'post',
					url: 'fetch_pwd.php', //Here you will fetch records 
					data: 'rowid=' + rowid, //Pass $id
					success: function ( data ) {
						$( '.fetched-data-cpay' ).html( data ); //Show fetched data from database
					}
				} );
			} );
		} );
		</script>