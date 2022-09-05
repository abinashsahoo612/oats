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
		<title>Site Allottment</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Site Allottment </h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-12 col-md-12 col-xs-12">
          <?php
          if (empty($_REQUEST['s_id'])) {
            $s_id = '0';
          } else {
            $s_id = $_REQUEST['s_id'];
          }
          $results = $db->query("SELECT * FROM site WHERE s_id = '$s_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="pages/action-site.php" enctype="multipart/form-data" method="post" >
		  
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Site allotted to</label>
				<select name="s_allotto" id="s_allotto" class="form-control input-sm" required>
					<option value="">Select Allottment</option>
					<option <?php
								if (!empty($_REQUEST['s_id'])) {
									if ($row->s_allotto === 'OATS') {
										echo 'selected';
									}
								}
							?> value="OATS">OATS</option>
					<option <?php
								if (!empty($_REQUEST['s_id'])) {
									if ($row->s_allotto === 'Vendor') {
										echo 'selected';
									}
								}
							?> value="Vendor">Vendor</option>
				</select>
			</div>
			</div>
		<div class="col-lg-3 col-md-3 col-xs-12">
		  <div class="form-group">
				<label>Select Circle </label>
				<select name="s_circle" id="s_circle" class="form-control input-sm" required>
					<option value="">Select Circle</option>
					<?php
						$sql = $db->query("select * from circle ");
						if (mysqli_num_rows($sql) > 0) {
							while ($query = $sql->fetch_object()) {
							?>
							<option <?php
								if (!empty($_REQUEST['s_id'])) {
									if ($row->s_circle === $query->c_id) {
										echo 'selected';
									}
								}
							?> value="<?php echo $query->c_id; ?>"><?php echo $query->c_name; ?></option>
							<?php
							}
						}
					?>
					
				</select>
			</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Select Department</label>
				<select name="s_department" id="s_department" class="form-control input-sm" required>
					<option value="">Select Department</option>
					<?php
						$sqld = $db->query("select * from department ");
						if (mysqli_num_rows($sqld) > 0) {
							while ($queryd = $sqld->fetch_object()) {
							?>
							<option <?php
								if (!empty($_REQUEST['s_id'])) {
									if ($row->s_department === $queryd->d_id) {
										echo 'selected';
									}
								}
							?> value="<?php echo $queryd->d_id; ?>"><?php echo $queryd->d_name; ?></option>
							<?php
							}
						}
					?>
				</select>
			</div>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Select Cluster</label>
				<select name="s_cluster" id="s_cluster" class="form-control input-sm" required>
					<option value="">Select Cluster</option>
					<?php
						$sqld = $db->query("select * from cluster ");
						if (mysqli_num_rows($sqld) > 0) {
							while ($queryd = $sqld->fetch_object()) {
							?>
							<option <?php
								if (!empty($_REQUEST['s_id'])) {
									if ($row->s_cluster === $queryd->c_id) {
										echo 'selected';
									}
								}
							?> value="<?php echo $queryd->c_id; ?>"><?php echo $queryd->c_name; ?></option>
							<?php
							}
						}
					?>
				</select>
			</div>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Select Scope</label><br>
				<iv>
					<?php
						$sqld = $db->query("select * from scope ");
						if (mysqli_num_rows($sqld) > 0) {
							while ($queryd = $sqld->fetch_object()) {
							?>
							
		
                  <input type="checkbox" value="<?php echo $queryd->s_id; ?>"  name="s_scope[]" ><?php echo $queryd->s_name; ?>
							<?php
							}
						}
					?></div>
			</div>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Date:</label>
              <input type="date" class="form-control input-sm" name="s_date" value="<?php
              if (!empty($row->s_date)) {
                echo $row->s_date;
              }
              ?>" placeholder="YY-MM-DD *" required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			
            <div class="form-group">
              <label>Site ID:</label>
			  <input  type="text" class="form-control input-sm" name="s_siteid" value="<?php
              if (!empty($row->s_siteid)) {
                echo $row->s_siteid;
              }
              ?>" placeholder="Site Id ">
																	
             
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Site Name</label>
              <input type="text" class="form-control input-sm" name="s_name" id="s_name" value="<?php
              if (!empty($row->s_sitename)) {
                echo $row->s_sitename;
              }
              ?>" placeholder="Site name *"  required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			
            <div class="form-group">
              <label>Address:</label>
              <input type="text" class="form-control input-sm" name="s_addrs" id="s_addrs" value="<?php
              if (!empty($row->s_addrs)) {
                echo $row->s_addrs;
              }
              ?>" placeholder="Address *"  required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Work Order No:</label>
              <input type="text" class="form-control input-sm" name="s_wono" id="s_wono" value="<?php
              if (!empty($row->s_workno)) {
                echo $row->s_workno;
              }
              ?>" placeholder="Work Order No "  required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Client Unit price:</label>
              <input type="text" class="form-control input-sm" name="s_cunitprice" id="s_cunitprice" value="<?php
              if (!empty($row->s_cunitprice)) {
                echo $row->s_cunitprice;
              }
              ?>" placeholder="Client Unt price "  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			 <div class="form-group">
              <label>Vendor Unit price:</label>
              <input type="text" class="form-control input-sm" name="s_vunitprice" value="<?php
              if (!empty($row->s_vunitprice)) {
                echo $row->s_vunitprice;
              }
              ?>" placeholder="Vendor unit price " required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <?php if (!empty($_REQUEST['s_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updatesite" />
                <input type="hidden" name="s_id" value="<?= $row->s_id; ?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-success">
                <input type="hidden" name="submit" value="addsite" />
              <?php } ?>
            </div>
            </div>
          </form>
        </div>
		
		<div class="col-lg-12 col-md-12 col-xs-12">
			
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="dataTable_wrapper">
							<table width="100%" class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
								<thead>
									<tr>
										<th class="no-sort">Sl.</th>
										<th>Site Allotted To</th>
										<th>Circle</th>
										<th>Department</th>
										<th>Cluster</th>
										<th>Scope</th>
										<th>Date</th>
										<th>Site Id</th>
										<th>Site Name</th>
										<th>Address</th>
										<th>Work Order no</th>
										<th>Client Unit price</th>
										<th>Vendor Unit price</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM `site`" );
									while ( $value = $data->fetch_object() ) {
										$sl++;

										?>
									<tr>
										<td>
											<?= $sl; ?>
										</td>
										<td><?= $value->s_allotto; ?></td>	
										<td><?php
												$c_id = $value->s_circle;
												$sqlc = $db->query("select * from circle WHERE c_id = '$c_id'");
												if((mysqli_num_rows($sqlc)) > 0) {
												$queryc = $sqlc->fetch_object();
												echo $queryc->c_name;
												}
										?></td>	
									
										<td><?php
												$d_id = $value->s_department;
												$sqld = $db->query("select * from department WHERE d_id = '$d_id'");
												if((mysqli_num_rows($sqld)) > 0) {
												$queryd = $sqld->fetch_object();
												echo $queryd->d_name;
												}
										?></td>	
										<td><?php
												$c_id = $value->s_cluster;
												$sqld = $db->query("select * from cluster WHERE c_id = '$c_id'");
												if((mysqli_num_rows($sqld)) > 0) {
												$queryd = $sqld->fetch_object();
												echo $queryd->c_name;
												}
										?></td>	
										<td><?php
										$scope = $value->s_scope;
										foreach ( explode( ',', $scope ) as $perm ) { 
											$s_id = $perm;
												$sqld = $db->query("select * from scope WHERE s_id = '$s_id'");
												if((mysqli_num_rows($sqld)) > 0) {
												$queryd = $sqld->fetch_object();
												$scope = $queryd->s_name;
												echo $scope.','; 
												}
											
											}	?></td>
										<!-- <td><?php
												// $s_id = $value->s_scope;
												// $sqld = $db->query("select * from scope WHERE s_id = '$s_id'");
												// if((mysqli_num_rows($sqld)) > 0) {
												// $queryd = $sqld->fetch_object();
												// echo $queryd->s_name;
												//}
										?></td>	 -->
										<td><?= $value->s_date; ?></td>	
										<td><?= $value->s_siteid; ?></td>	
										<td><?= $value->s_sitename; ?></td>	
										<td><?= $value->s_addrs; ?></td>	
										<td><?= $value->s_workno; ?></td>	
										<td><?= $value->s_cunitprice; ?></td>
										<td><?= $value->s_vunitprice; ?></td>
										<td>
													
												<a href="?s_id=<?= $value->s_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
												<a href="pages/action-site.php?s_id=<?= $value->s_id; ?>&submit=delete" class="btn btn-danger btn-xs" onClick="return confirm('Are You Sure want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
										</td>
										<td>
												<?php 	if($value->s_status == '2') {	?>
													<?= 'Completed'; ?>
												<?php } else { ?>
												<a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalpending">Pending</a>
													<?php } ?>
												</td>		
							<div class="modal fade" id="myModalpending" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Complete The Process </h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" role="form" action="pages/action-site" enctype="multipart/form-data" method="post">
											<div class="form-group" style="margin-bottom:45px;">
												<label class="col-sm-4 control-label">Completed date</label>
												<div class="col-sm-8">
													<input class="form-control" placeholder="" name="s_cmpdate" type="date">
												</div>
											</div>
											<div class="form-group" style="margin-bottom:80px;">
												<label class="col-sm-4 control-label">Remark</label>
												<div class="col-sm-8">
													<input class="form-control" placeholder="" name="s_remark" type="text">
												</div>
											</div>
											<div class="form-group" style="margin-bottom:45px;">
												<div class="col-sm-offset-4 col-sm-8">
													<button type="submit" class="btn btn-primary">Update</button>
													<input type="hidden" name="submit" value="pending" />
													<input type="hidden" name="s_id" value="<?= $value->s_id; ?>" />
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer" style="border:none;">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
									
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#page-wrapper -->
<?php include_once 'footer.php'; ?>
<script type="text/javascript">
	$( document ).ready( function () {
		$( '#e_circle' ).on( 'change', function () {
			var productID = $( this ).val();
			if ( productID ) {
				$.ajax( {
					type: 'POST',
					url: 'ajax_location.php',
					data: 'pid=' + productID,
					success: function ( html ) {
						$( '#e_location' ).html( html );
					}
				} );
			} else {
				$( '#e_location' ).html( '<option value="">Choose Circle First</option>' );
			}
		} );


	} );
	
	$(document).ready(function(){
  
  $("#e_contact").on("blur", function(){
        var mobNum = $(this).val();
        var filter = /^\d*(?:\.\d{1,2})?$/;

          if (filter.test(mobNum)) {
            if(mobNum.length==10){
                  alert("valid");
             } else {
                alert('Please put 10  digit mobile number');
                return false;
              }
            }
            else {
              alert('Not a valid number');
              return false;
           }
    
  });
  
});
	
</script>
