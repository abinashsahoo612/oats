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

	
// $dept = '';$ea_date = date('Y-m-d');
// if ($_REQUEST && $_REQUEST['submit'] == 'getemployees') {
	if(empty($_REQUEST['ea_department'])){
		$dept = '';
		$ea_date  = '';	
	}else{
	 $dept = mysqli_real_escape_string($db, $_REQUEST['ea_department']);	
	$ea_date = mysqli_real_escape_string($db, $_REQUEST['ea_date']);
	}
// }

$a_id = $_SESSION['a_id'];
$results = $db->query("SELECT * FROM admin WHERE a_id = '$a_id'");
$ad_row = $results->fetch_object();
$dept = $ad_row->a_dept;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Daily Attendance</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Daily Attendance </h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-12 col-md-12 col-xs-12">
          <form name="frm" id="frm" action="pages/action-emp-attendance" enctype="multipart/form-data" method="post" >
		<div class="col-lg-4 col-md-4 col-xs-12">
		  <div class="form-group">
				<label>Select Department </label>
				<select name="ea_department" id="ea_department" class="form-control input-sm" required>
					<option value="">Select Department</option>
					<?php
						$sql = $db->query("SELECT  * from department WHERE d_id='$dept'");
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
            </div>
			
		<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label>Date:</label>
              <input type="date" class="form-control input-sm" name="ea_date" value="" placeholder="YY-MM-DD *" required>
            </div>
            </div>
		<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <input type="submit" name="submitf" id="submit" value="Get Employees" class="btn btn-success">
                <input type="hidden" name="submit" value="getemployees" />
            </div>
            </div>
          </form>
        </div>
	</div>
</div>


<div class="row">
				<div class="col-sm-12">


				<?php if( date('l', strtotime($ea_date)) == 'Sunday'){ ?>
							
					

				<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center;"><h3><?= date('l', strtotime($ea_date)); ?></h3></div>
				<div class="panel-body">
				<h4 style="text-align:center;">This is sunday</h4>
				</div>
				</div>
				<?php
					} else{
						$tdata = $db->query("SELECT * FROM  holidaydetails where hd_date = '$ea_date'");
						$count = mysqli_num_rows($tdata);
						if($count > 0){
							$value = $tdata->fetch_object();
							$name = $value->hd_name;
							
							$sqls = $db->query("select * from holiday where h_id = '$name' ");
							$querys = $sqls->fetch_object();
							?>
							
											
				<div class="panel panel-default">
				<div class="panel-heading" style="text-align:center;"><h3>
				<?php  echo $querys->h_name; ?></h3></div>
				<div class="panel-body">
				<h4 style="text-align:center;">This is 
				<?php echo $querys->h_name; ?></h4>
				</div>
				</div>
				<?php
						} else {
				?>
				<div class="panel panel-default">
					<?php
					$dataf = $db->query("SELECT * FROM  finalattendance where fa_department = '$dept' AND fa_date = '$ea_date' AND fa_user = '$a_idchk'");
					$count = mysqli_num_rows($dataf);
					// if(!empty($valuef->fa_status)){
					// 	$status = $valuef->fa_status;
					// } else{
					// 	$status = '';
					// }
					?>
						<div class="panel-heading"><B>Daily Attendance: &nbsp;<i class="text-primary"> <?= $ea_date ?></i>&nbsp;&nbsp;
						Department : <i class="text-primary"> <?= $dept ?></i></b>
						<?php 
								if($count > 0){
						?>

						<a href="#" class="btn btn-primary btn-xs" style="float: right;" disabled>   <span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp; attendance Submitted</a>
						<?php }else { ?>
							<a href="pages/action-emp-attendance?ea_did=<?= $dept; ?>&ea_date=<?= $ea_date;?>&submit=submitattnd" class="btn btn-primary btn-xs" style="float: right;" >   <span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Submit attendance</a><?php } ?>
					</div>

						<!-- /.panel-heading -->
						<div class="panel-body">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>Sl No</th>
                                        <th>Department</th>
                                        <th>Employee</th>
                                        <th>Date.</th>
                                        <th>Status</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sl = 0;
										$tdataa = $db->query("SELECT * FROM  attendance where ea_department = '$dept' AND ea_date = '$ea_date' AND ea_user = '$a_idchk' ");
										while ($valuea = $tdataa->fetch_object()) {
											$emp = $valuea->ea_employee;
											$daten=strtotime($ea_date);
											$year=date("Y",$daten);
											$sl++;
										?>
										<tr>
											<td><?= $sl; ?></td>
                                            <td>
												<?php
													$dept = $valuea->ea_department; 
													$sql = $db->query("select * from department where d_id='$dept' ");
													$query = $sql->fetch_object();
													echo $query->d_name;
												?>
                                            <td>
												<?php
															$spid = $valuea->ea_employee;
															$sqle = $db->query("select * from employee WHERE e_id = '$spid'");
															if((mysqli_num_rows($sqle)) > 0) {
															$querye = $sqle->fetch_object();
															echo $querye->e_name;
															}
													?>	
											</td>
                                            <td><?= mysqlToFormat($ea_date,'d-m-Y'); ?></td>
                                         
										<td><?= $valuea->ea_astatus; ?>	</td>
											<td>
											<?php 	if($valuea->ea_astatus != 'P') {	?>
												<?= $valuea->ea_reason; ?>
											<?php } else { ?>
												<?php 
														if($count > 0){
												?>
												


												<a href="#" class="btn btn-danger btn-xs"disabled>Make absent</a>
												<?php } else { ?>


													<a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalabsent<?= $sl; ?>" >Make absent</a>
												<?php } } ?>
											</td>				
			<div class="modal fade" id="myModalabsent<?= $sl; ?>" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Absent</h4>
					</div>
				<div class="modal-body" style="padding-bottom:100px;">
				<?php
				$query = $db->query("SELECT * FROM `attendance` WHERE DATE_FORMAT(ea_date, '%Y') = '$year' AND ea_reason = 'CL' AND ea_employee = '$emp' ");
				$rowc = $query->fetch_object();
				$countc = mysqli_num_rows($query);
				$queryrc = $db->query("SELECT * FROM `reason` WHERE  r_type = 'CL' ");
				$rowrc = $queryrc->fetch_object();
				$daysc = $rowrc->r_days;
				$cldays =  $daysc -  $countc;
				
				$querye = $db->query("SELECT * FROM `attendance` WHERE DATE_FORMAT(ea_date, '%Y') = '$year' AND ea_reason = 'EL' AND ea_employee = '$emp' ");
				$rowe = $querye->fetch_object();
				$counte = mysqli_num_rows($querye);
				$queryre = $db->query("SELECT * FROM `reason` WHERE  r_type = 'EL' ");
				$rowre = $queryre->fetch_object();
				$dayse = $rowre->r_days;
				$eldays =  $dayse -  $counte;
				
				$querys = $db->query("SELECT * FROM `attendance` WHERE DATE_FORMAT(ea_date, '%Y') = '$year' AND ea_reason = 'SPL' AND ea_employee = '$emp' ");
				$rows = $querys->fetch_object();
				$counts = mysqli_num_rows($querys);
				$queryrs = $db->query("SELECT * FROM `reason` WHERE  r_type = 'SPL' ");
				$rowrs = $queryrs->fetch_object();
				$dayss = $rowrs->r_days;
				$sldays =  $dayss -  $counts;
				?>
					<div class="col-lg-12 col-md-12 col-xs-12">
						<div class="col-lg-4 col-md-4 col-xs-12">
						<strong>No Of Leaves remaining:</strong><br>
						</div>
						<div class="col-lg-8 col-md-8 col-xs-12">
						<strong>CL:&nbsp;</strong><?= $cldays ?>&nbsp;days,&nbsp;&nbsp;
						<strong>EL:&nbsp;</strong><?= $eldays ?>&nbsp;days,&nbsp;&nbsp;
						<strong>SPL:&nbsp;</strong><?= $sldays ?>&nbsp;days&nbsp;&nbsp;
						</div>
					</div><hr>
					<div class="col-lg-12 col-md-12 col-xs-12">
					<form class="form-horizontal" role="form" action="pages/action-emp-attendance" enctype="multipart/form-data" method="post">
						<div class="col-lg-4 col-md-4 col-xs-12">
							<div class="form-group">
								<label>Leave Type</label>
								<select name="ea_reason" id="" class="form-control input-sm " required>
									<option value="">Select Absent Type</option>
									<?php
										$sql = $db->query("select * from reason ");
										if (mysqli_num_rows($sql) > 0) {
											while ($query = $sql->fetch_object()) {
												$type = $query->r_type;
											?>
											<option <?php if ( (($type == 'CL') &&($cldays == '0') )|| (($type == 'EL') &&($eldays == '0') ) || (($type == 'SPL') && ($sldays == '0') )){echo 'disabled';} ?> value="<?php echo $query->r_type; ?>"><?php echo $query->r_type; ?></option>
											<?php
											}
										}
									?>
									<option value="Loss Of pay">Loss Of pay</option>
								</select>
							</div>
						</div>
								
							<div class="col-lg-4 col-md-4 col-xs-12">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Update </button>
									<input type="hidden" name="submit" value="absent" />
									<input type="hidden" name="ea_id" id="ea_id" value="<?= $emp; ?>" />
									<input type="hidden" name="ea_did" value="<?= $dept; ?>" />
									<input type="hidden" id="date" name="ea_date" value="<?= $ea_date; ?>" />
								</div>
								</div>
							</div>
						</form>
					</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
									</tr>
								<?php }  ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php } }?>


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

		$( '#ea_reason' ).on( 'change', function () {alert('hhhh');
		var productID = $( this ).val();
		var date = $('#date').val();
		var emp = $('#ea_id').val();//alert(emp);
		if ( productID ) {
			$.ajax( {
				type: 'POST',
				url: 'ajax_leavedays.php',
				data: {pid: productID,date: date,emp: emp},
				success: function ( html ) { 
					$( '.ea_days' ).val( html );
				}
			} );
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
	<script>
    $(function(){           
        if (!Modernizr.inputtypes.date) {
            $('input[type=date]').datepicker({
                  dateFormat : 'yy-mm-dd'
                }
             );
        }
    });
</script>