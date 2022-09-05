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
		<title>Employee Attendance</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Employee Attendance </h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-3 col-md-3 col-xs-12">
          <?php
          if (empty($_REQUEST['ea_id'])) {
            $ea_id = '0';
          } else {
            $ea_id = $_REQUEST['ea_id'];
          }
          $results = $db->query("SELECT * FROM attendance WHERE ea_id = '$ea_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="pages/action-emp-attendance.php" enctype="multipart/form-data" method="post" >
		  <div class="form-group">
				<label>Select Department </label>
				<select name="ea_department" id="ea_department" class="form-control input-sm" required>
					<option value="">Select Department</option>
					<?php
						$sql = $db->query("select * from department ");
						if (mysqli_num_rows($sql) > 0) {
							while ($query = $sql->fetch_object()) {
							?>
							<option <?php
								if (!empty($_REQUEST['ea_id'])) {
									if ($row->ea_department === $query->d_id) {
										echo 'selected';
									}
								}
							?> value="<?php echo $query->d_id; ?>"><?php echo $query->d_name; ?></option>
							<?php
							}
						}
					?>
					
				</select>
			</div>
		   <div class="form-group">
				<label>Select Employee:</label>
				<select name="ea_employee" id="ea_employee" class="form-control input-sm " required>
							<option value=""> Choose Department First</option>
							<!--Sub category goes here-->
							<?php 
									if (!empty(ea_employee)) {
									$l_id = $row->ea_employee;
									$sqlt1 = $db->query("select * from employee WHERE e_id = '$l_id'");
									while ($queryt1 = $sqlt1->fetch_object()) {
							?>
							<option <?php if($row->ea_employee == $queryt1->e_id){ echo 'selected';} ?> value="
								<?= $queryt1->e_id; ?>">
								<?= $queryt1->e_name; ?>
							</option>
							<?php  } }?>
				</select>
			</div>
            <div class="form-group">
              <label>Date:</label>
              <input type="date" class="form-control input-sm" name="ea_date" value="<?php
              if (!empty($row->ea_date)) {
                echo $row->ea_date;
              }
              ?>" placeholder="YY-MM-DD *" required>
            </div>
			 <div class="form-group">
				<label>Status:</label>
				<select name="ea_astatus" id="ea_astatus" class="form-control input-sm " required>
					<option value="P">Present</option>
					<option value="A">Absent</option>
					
				</select>
			</div>
            <div class="form-group">
              <label>In Time:</label>
              <input type="text" class="form-control input-sm" name="ea_intime" id="ea_intime" value="<?php
              if (!empty($row->ea_intime)) {
                echo $row->ea_intime;
              }
              ?>" placeholder="In Time *" required>
            </div>
            <div class="form-group">
              <label>Out Time:</label>
              <input type="text" class="form-control input-sm" name="ea_outtime" id="ea_outtime" value="<?php
              if (!empty($row->ea_outtime)) {
                echo $row->ea_outtime;
              }
              ?>" placeholder="Out Time *" required>
            </div>
			 <div class="form-group">
				<label>Reason:</label>
				<select name="ea_reason" id="ea_reason" class="form-control input-sm "  disabled>
					<option value="Leave">Leave</option>
					<option value="Holiday">Holiday</option>
					
				</select>
			</div>
            <div class="form-group">
              <?php if (!empty($_REQUEST['ea_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updateempattendance" />
                <input type="hidden" name="ea_id" value="<?= $row->ea_id; ?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-success">
                <input type="hidden" name="submit" value="addempattendance" />
              <?php } ?>
            </div>
          </form>
        </div>
		
		<div class="col-lg-9 col-md-9 col-xs-12">
			
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="dataTable_wrapper">
							<table width="100%" class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
								<thead>
									<tr>
										<th class="no-sort">Sl.</th>
<!--										<th class="no-sort">Action</th>-->
										<th>Department</th>
										<th>Employee</th>
										<th>Date</th>
										<th>In Time</th>
										<th>Out Time</th>
										<th>Status</th>
										<th>Reason Of Absence</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM `attendance`" );
									while ( $value = $data->fetch_object() ) {
										$sl++;
										?>
									<tr>
										<td>
											<?= $sl; ?>
										</td>
									
										<td>
											
										<?php
												$circle = $value->ea_department; 
												$sqls = $db->query("select * from department where d_id = '$circle' ");
												if (mysqli_num_rows($sql) > 0) {
												$querys = $sqls->fetch_object();
												echo $querys->d_name;
												}
										?>
										</td>	
									
									<td>
										
									<?php
											$employee = $value->ea_employee; 
											$sqls = $db->query("select * from employee where e_id = '$employee' ");
											if (mysqli_num_rows($sql) > 0) {
											$querys = $sqls->fetch_object();
											echo $querys->e_name;
											}
									?>
									</td>	
										<td><?= $value->ea_date; ?></td>	
										<td>
											
										<?php
												$status = $value->ea_astatus; 
												if($status == 'P'){
													echo $value->ea_intime;;
												}else{
													echo 'NA';
												}
										?>
									
									</td>	
										<td>
											
										<?php
												$status = $value->ea_astatus; 
												if($status == 'P'){
													echo $value->ea_outtime;
												}else{
													echo 'NA';
												}
										?>
									
									</td>	
										<td>
											
										<?php
												$status = $value->ea_astatus; 
												if($status == 'P'){
													echo 'Present';
												}else{
													echo 'Absent';
												}
										?>
									
									</td>	
										<td>
											
										<?php
												$status = $value->ea_astatus; 
												if($status == 'P'){
													echo 'NA';
												}else{
													echo $value->ea_reason;
												}
										?>
									
									</td>	
										<td>
													
													<a href="?ea_id=<?= $value->ea_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
													<a href="pages/action-emp-attendance.php?ea_id=<?= $value->ea_id; ?>&submit=delete" class="btn btn-danger btn-xs" onClick="return confirm('Are You Sure want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
												
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
	$( document ).ready( function () {
		$( '#ea_department' ).on( 'change', function () {
			var productID = $( this ).val();
			if ( productID ) {
				$.ajax( {
					type: 'POST',
					url: 'ajax_employee.php',
					data: 'pid=' + productID,
					success: function ( html ) {
						$( '#ea_employee' ).html( html );
					}
				} );
			} else {
				$( '#ea_employee' ).html( '<option value="">Choose Departmet First</option>' );
			}
		} );

		
		$( '#ea_astatus' ).on( 'change', function () {
			var status= $( this ).val();

			if(status == 'P'){
				$("#ea_intime").prop("disabled", false);
				$("#ea_outtime").prop("disabled", false);
				$("#ea_reason").prop("disabled", true);
			} else {
				
				$("#ea_intime").prop("disabled", true);
				$("#ea_outtime").prop("disabled", true);
				$("#ea_reason").prop("disabled", false);
			}
	});


	} );
	</script>