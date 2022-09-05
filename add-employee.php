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
		<title>Employee</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Add Employee </h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-12 col-md-12 col-xs-12">
          <?php
          if (empty($_REQUEST['e_id'])) {
            $e_id = '0';
          } else {
            $e_id = $_REQUEST['e_id'];
          }
          $results = $db->query("SELECT * FROM employee WHERE e_id = '$e_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="pages/action-employee.php" enctype="multipart/form-data" method="post" >
		  
		<div class="col-lg-3 col-md-3 col-xs-12">
		  <div class="form-group">
				<label>Select Circle </label>
				<select name="e_circle" id="e_circle" class="form-control input-sm" required>
					<option value="">Select Circle</option>
					<?php
						$sql = $db->query("select * from circle ");
						if (mysqli_num_rows($sql) > 0) {
							while ($query = $sql->fetch_object()) {
							?>
							<option <?php
								if (!empty($_REQUEST['e_id'])) {
									if ($row->e_circle === $query->c_id) {
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
				<label>Select Location</label>
				<select name="e_location" id="e_location" class="form-control input-sm" required>
				
				
							<option value=""> Choose Circle First</option>
							<!--Sub category goes here-->
							<?php 
									if (!empty($row->e_location)) {
									$l_id = $row->e_location;
									$sqlt1 = $db->query("select * from location WHERE l_id = '$l_id'");
									while ($queryt1 = $sqlt1->fetch_object()) {
							?>
							<option <?php if($row->e_location == $queryt1->l_id){ echo 'selected';} ?> value="
								<?= $queryt1->l_id; ?>">
								<?= $queryt1->l_name; ?>
							</option>
							<?php  } }?>
							
						
					
				</select>
			</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Select Department</label>
				<select name="e_department" id="e_department" class="form-control input-sm" required>
					<option value="">Select Department</option>
					<?php
						$sqld = $db->query("select * from department ");
						if (mysqli_num_rows($sqld) > 0) {
							while ($queryd = $sqld->fetch_object()) {
							?>
							<option <?php
								if (!empty($_REQUEST['e_id'])) {
									if ($row->e_department === $queryd->d_id) {
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
              <label>Employee Name:</label>
              <input type="text" class="form-control input-sm" name="e_name" value="<?php
              if (!empty($row->e_name)) {
                echo $row->e_name;
              }
              ?>" placeholder="employee Name *" required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			
            <div class="form-group">
              <label>Father's Name:</label>
              <input type="text" class="form-control input-sm" name="e_fname" value="<?php
              if (!empty($row->e_fname)) {
                echo $row->e_fname;
              }
              ?>" placeholder="Father's Name *" required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Select Gender</label>
				<select name="e_gender" id="e_gender" class="form-control input-sm" required>
				
				<option value="">Select Gener</option>
				<option <?php
					if (!empty($_REQUEST['e_id'])) {
						if ($row->e_gender === 'Male') {
							echo 'selected';
						}
					}
				?> value="Male">Male</option>
				<option <?php
					if (!empty($_REQUEST['e_id'])) {
						if ($row->e_gender === 'Female') {
							echo 'selected';
						}
					}
				?> value="Female">Female</option>
					
				</select>
			</div>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Select Blood Group</label>
				<select name="e_bgroup" id="e_bgroup" class="form-control input-sm" required>
					<option value="">Select Blood group</option>
						<option <?php
									if (!empty($_REQUEST['e_id'])) {
										if ($row->e_bgroup === 'A+') {
											echo 'selected';
										}
									}
								?> value="A+">A+</option>
						<option <?php
									if (!empty($_REQUEST['e_id'])) {
										if ($row->e_bgroup === 'A-') {
											echo 'selected';
										}
									}
								?> value="A-">A-</option>
						<option <?php
									if (!empty($_REQUEST['e_id'])) {
										if ($row->e_bgroup === 'B+') {
											echo 'selected';
										}
									}
								?> value="B+">B+</option>
						<option <?php
									if (!empty($_REQUEST['e_id'])) {
										if ($row->e_bgroup === 'B-') {
											echo 'selected';
										}
									}
								?> value="B-">B-</option>
						<option <?php
									if (!empty($_REQUEST['e_id'])) {
										if ($row->e_bgroup === 'AB+') {
											echo 'selected';
										}
									}
								?> value="AB+">AB+</option>
						<option <?php
									if (!empty($_REQUEST['e_id'])) {
										if ($row->e_bgroup === 'AB-') {
											echo 'selected';
										}
									}
								?> value="AB-">AB-</option>
						<option <?php
									if (!empty($_REQUEST['e_id'])) {
										if ($row->e_bgroup === 'O+') {
											echo 'selected';
										}
									}
								?> value="O+">O+</option>
						<option <?php
									if (!empty($_REQUEST['e_id'])) {
										if ($row->e_bgroup === 'O-') {
											echo 'selected';
										}
									}
								?> value="O-">O-</option>
				</select>
			</div>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Contact No</label>
              <input type="text" class="form-control input-sm" name="e_contact" id="e_contact" value="<?php
              if (!empty($row->e_contact)) {
                echo $row->e_contact;
              }
              ?>" placeholder="Contact no *"  required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Alternate Contact No</label>
              <input type="text" class="form-control input-sm" name="e_acontact" id="e_acontact" value="<?php
              if (!empty($row->e_acontact)) {
                echo $row->e_acontact;
              }
              ?>" placeholder="Contact no *"  >
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Email Id</label>
              <input type="text" class="form-control input-sm" name="e_email" id="e_email" value="<?php
              if (!empty($row->e_email)) {
                echo $row->e_email;
              }
              ?>" placeholder="Contact no *"  required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			
            <div class="form-group">
              <label>Present Address:</label>
              <textarea type="text" class="form-control input-sm" name="e_addr"   ><?php
              if (!empty($row->e_addr)) {
                echo $row->e_addr;
              }
              ?></textarea>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Permanent Address:</label>
              <textarea type="text" class="form-control input-sm" name="e_paddr"   ><?php
              if (!empty($row->e_paddr)) {
                echo $row->e_paddr;
              }
              ?></textarea>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Bank Details:</label>
              <textarea type="text" class="form-control input-sm" name="e_bdetails"   required><?php
              if (!empty($row->e_addr)) {
                echo $row->e_addr;
              }
              ?></textarea>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Employee Code:</label>
			  
			  <input readonly type="text" class="form-control input-sm" name="e_code" value="<?php
					if (empty($row->e_code)) {
						$drs = $db->query("SELECT * FROM employee WHERE e_status = '1' ORDER BY e_id DESC LIMIT 1");
						$count = mysqli_num_rows($drs);
						$num = '1';
						if ($count==0){
							echo 'OATS'. sprintf("%03d", $num);
							} else {
							$drs_two = $db->query("SELECT * FROM employee WHERE e_status = '1'  ORDER BY e_id DESC LIMIT 1");
							$drs_data = $drs_two->fetch_object();
								$drs_no = $drs_data->e_code;
							preg_match_all('!\d!', $drs_no, $matches);
							$db_drs = (int)implode('',$matches[0]);
							$plus =  $db_drs + 1;
							
							echo 'OATS'.sprintf("%03d", $plus);
						}
					}
					if (!empty($row->e_code)) {
						echo $row->e_code;
					}
					?>" placeholder="Auto Generate ">
																	
             
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
		
            <div class="form-group">
				<label>Select Designation</label>
				<select name="e_designation" id="e_designation" class="form-control input-sm" required>
					<option value="">Select Designation</option>
					<?php
						$sqld = $db->query("select * from designation ");
						if (mysqli_num_rows($sqld) > 0) {
							while ($queryd = $sqld->fetch_object()) {
							?>
							<option <?php
								if (!empty($_REQUEST['e_id'])) {
									if ($row->e_designation === $queryd->ds_id) {
										echo 'selected';
									}
								}
							?> value="<?php echo $queryd->ds_id; ?>"><?php echo $queryd->ds_name; ?></option>
							<?php
							}
						}
					?>
				</select>
			</div>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Select Job Category</label>
				<select name="e_jobcat" id="e_jobcat" class="form-control input-sm" required>
					<option value="">Select Job Category</option>
						<option <?php
									if (!empty($_REQUEST['e_id'])) {
										if ($row->e_jobcat === 'P') {
											echo 'selected';
										}
									}
								?> value="P">Permanent</option>
						<option <?php
									if (!empty($_REQUEST['e_id'])) {
										if ($row->e_jobcat === 'C') {
											echo 'selected';
										}
									}
								?> value="C">Contractual</option>
					
				</select>
			</div>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			 <div class="form-group">
              <label>ESIC NO:</label>
              <input type="text" class="form-control input-sm" name="e_esicno" value="<?php
              if (!empty($row->e_esicno)) {
                echo $row->e_esicno;
              }
              ?>" placeholder="ESIC No *" required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
              <label>EPF UAN:</label>
              <input type="text" class="form-control input-sm" name="e_epf" value="<?php
              if (!empty($row->e_epf)) {
                echo $row->e_epf;
              }
              ?>" placeholder="EPF *" required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Date of Birth:</label>
              <input type="date" class="form-control input-sm" name="e_dob" value="<?php
              if (!empty($row->e_dob)) {
                echo $row->e_dob;
              }
              ?>" placeholder="YY-MM-DD *" required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Date of Joining:</label>
              <input type="date" class="form-control input-sm" name="e_doj" value="<?php
              if (!empty($row->e_doj)) {
                echo $row->e_doj;
              }
              ?>" placeholder="YY-MM-DD *" required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <?php if (!empty($_REQUEST['e_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updateemployee" />
                <input type="hidden" name="e_id" value="<?= $row->e_id; ?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-success">
                <input type="hidden" name="submit" value="addemployee" />
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
										<th class="no-sort">Account Setup</th>
										<th>Circle</th>
										<th>Place</th>
										<th>Department</th>
										<th>Name</th>
										<th>Father's name</th>
										<th>Gender</th>
										<th>Blood Group</th>
										<th>Email Id</th>
										<th>Contact Number</th>
										<th>Alternate Contact Number</th>
										<th>Address</th>
										<th>Permanent Address</th>
										<th>Bank Details</th>
										<th>Employee Code</th>
										<th>Designation</th>
										<th>Job Cat</th>
										<th>ESIC NO</th>
										<th>EPF UAN</th>
										<th>DOB</th>
										<th>DOJ</th>
										<th>Action</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM `employee`" );
									while ( $value = $data->fetch_object() ) {
										$sl++;
										?>
									<tr <?php if ($value->e_status === '2') { echo 'style="text-decoration: line-through; color: #999;"'; } ?>>
										<td>
											<?= $sl; ?>
										</td>
									
										<td>
										<?php if ($value->e_status == '1') { ?> 	
												<a href="add-salary-setup?e_id=<?= $value->e_id; ?>" class="btn btn-primary btn-xs"><i class="fa fa-gear fa-fw"></i>AccountSetup</a>
												<?php }else { ?>
													
												<a href="#" class="btn btn-primary btn-xs"  disabled><i class="fa fa-gear fa-fw"></i>AccountSetup</a>
												<?php } ?>
										</td>
										<td><?php
												$c_id = $value->e_circle;
												$sqlc = $db->query("select * from circle WHERE c_id = '$c_id'");
												if((mysqli_num_rows($sqlc)) > 0) {
												$queryc = $sqlc->fetch_object();
												echo $queryc->c_name;
												}
										?></td>	
										<td><?php
												$l_id = $value->e_location;
												$sqll = $db->query("select * from location WHERE l_id = '$l_id'");
												if((mysqli_num_rows($sqll)) > 0 ){
												$queryl = $sqll->fetch_object();
												echo $queryl->l_name;
												}
										?></td>	
										<td><?php
												$d_id = $value->e_department;
												$sqld = $db->query("select * from department WHERE d_id = '$d_id'");
												if((mysqli_num_rows($sqld)) > 0) {
												$queryd = $sqld->fetch_object();
												echo $queryd->d_name;
												}
										?></td>	
										<td><?= $value->e_name; ?></td>	
										<td><?= $value->e_fname; ?></td>	
										<td><?= $value->e_gender; ?></td>	
										<td><?= $value->e_bgroup; ?></td>		
										<td><?= $value->e_email; ?></td>
										<td><?= $value->e_contact; ?></td>	
										<td><?= $value->e_acontact; ?></td>	
										<td><?= $value->e_addr; ?></td>		
										<td><?= $value->e_paddr; ?></td>
										<td><?= $value->e_bdetails; ?></td>	
										<td><?= $value->e_code; ?></td>	
										<td><?php
												$ds_id = $value->e_designation;
												$sqlds = $db->query("select * from designation WHERE ds_id = '$ds_id'");
												if((mysqli_num_rows($sqlds)) > 0) {
												$queryds = $sqlds->fetch_object();
												echo $queryds->ds_name;
												}
										?></td>	
										<td><?= $value->e_jobcat; ?></td>	
										<td><?= $value->e_esicno; ?></td>	
										<td><?= $value->e_epf; ?></td>	
										<td><?= $value->e_dob; ?></td>	
										<td><?= $value->e_doj; ?></td>
										<td>
													
												<a href="?e_id=<?= $value->e_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
												<a href="pages/action-employee.php?e_id=<?= $value->e_id; ?>&submit=delete" class="btn btn-danger btn-xs" onClick="return confirm('Are You Sure want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
												
										</td>
										<td>
											<?php if ($value->e_status == '1') { ?> Active &nbsp; 
												<!-- <a href="pages/action-employee?e_id=<?= $value->e_id; ?>&submit=Disable" onClick="return confirm('Are You Sure want to Disable??')" class="btn btn-warning btn-xs" title="click to Disable"> <span class="glyphicon glyphicon-refresh"></span></a> -->

												
												<a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModaldisable" onClick="return confirm('Are You Sure want to Resign??')" title="click to Resign">Resign</a>

			<div class="modal fade" id="myModaldisable" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Resignation </h4>
					</div>
				<div class="modal-body" style="padding-bottom:100px;">
					<form class="form-horizontal" role="form" action="pages/action-employee" enctype="multipart/form-data" method="post">
						<div class="form-group">
							<label class="col-sm-4 control-label">Resign date</label>
							<div class="col-sm-8">
								<input class="form-control" placeholder="" name="r_date" type="date">
															
				
			</div>
		</div>
		<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<button type="submit" class="btn btn-primary">Update</button>
									<input type="hidden" name="submit" value="resign" />
									<input type="hidden" name="e_id" value="<?= $value->e_id; ?>" />
									<!-- <input type="hidden" name="ea_did" value="<?= $dept; ?>" />
									<input type="hidden" name="ea_date" value="<?= $ea_date; ?>" /> -->
								</div>
							</div>
						</form>
					</div>


			<?php } else { ?> Resigned
					<!-- <a href="pages/action-employee?e_id=<?= $value->e_id; ?>&submit=Enable" onClick="return confirm('Are You Sure want to Enable??')" class="btn btn-primary btn-xs" title="click to Enable"> <span class="glyphicon glyphicon-refresh"></span></a>3 -->

					
				<a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalenable" onClick="return confirm('Are You Sure want to Rejoin??')" title="click to Rejoin">Rejoin</a>

												
			<div class="modal fade" id="myModalenable" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Rejoin Employee </h4>
					</div>
			
					<div class="modal-body" style="padding-bottom:100px;">
					<form class="form-horizontal" role="form" action="pages/action-employee" enctype="multipart/form-data" method="post">
						<div class="form-group">
							<label class="col-sm-4 control-label">Rejoin date</label>
							<div class="col-sm-8">
								<input class="form-control" placeholder="" name="r_date" type="date">
			</div>
		</div>

							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<button type="submit" class="btn btn-primary">Update</button>
									<input type="hidden" name="submit" value="rejoin" />
									<input type="hidden" name="e_id" value="<?= $value->e_id; ?>" />
									<!-- <input type="hidden" name="ea_did" value="<?= $dept; ?>" />
									<input type="hidden" name="ea_date" value="<?= $ea_date; ?>" /> -->
								</div>
							</div>
						</form>
					</div>

											<?php } ?>
										</td>
									
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
	$(document).ready(function(){
		$( '#e_circle' ).on( 'change', function () {//alert('hello');
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
