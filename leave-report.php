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

$FromDate = $ToDate = date('Y-m-d');$dept = $year = $months = '';
if ($_POST && $_POST['submit'] == 'saleReport') {
	$year = mysqli_real_escape_string($db, $_REQUEST['year']);	
	//$months = mysqli_real_escape_string($db, $_REQUEST['month']);	
	$dept = mysqli_real_escape_string($db, $_REQUEST['department']);	
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Leave Report</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
			th,td { text-align:center;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Leave Reports</h2>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-heading"></div>
						<div class="panel-body">
							<form method="post">
								<table width="100%" class="table table-striped table-bordered table-hover" id="">
									<tbody>
										<tr>
											<td class="col-md-3">
												<div class="form-group date">
													<label for="FromDate">Select Department :</label>
													<select name="department" id="department" class="form-control input-sm">
														<option value="">Select Department</option>
														<?php
															$sql = $db->query("SELECT * FROM department WHERE d_status='1'");
															if (mysqli_num_rows($sql) > 0) {
																while ($query = $sql->fetch_object()) {
																?>
																<option value="<?php echo $query->d_id; ?>"><?php echo $query->d_name; ?></option>
																<?php
																}
															}
														?>
													</select>
												</div>
											</td>
											<td class="col-md-3">
												<div class="form-group date">
													<label for="ToDate"> Year:</label>  
													<?php
													$currently_selected = date('Y'); 
													$earliest_year = 1950; 
													$latest_year = date('Y'); 

													print '<select name="year" id="year" class="form-control input-sm">';
													foreach ( range( $latest_year, $earliest_year ) as $i ) {
														print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
													}
													print '</select">';
													?>
												</div>
											</td>
					<!-- <td class="col-md-3">
                      <div class="form-group date">
                        <label for="FromDate">From Date:</label>
                        <input type="date" class="form-control" placeholder="YYYY-MM-DD" id="fdate" name="FromDate" value="" >
                      </div>
                    </td>
                    <td class="col-md-3">
                      <div class="form-group date">
                        <label for="ToDate">To Date:</label>
                        <input type="date" class="form-control" placeholder="YYYY-MM-DD" id="tdate" name="ToDate" value="" required>
                      </div>
                    </td> -->
					<td class="col-md-2">
						<label for="ItemToDate"></label>
						<div class="form-group date">
							<input type="submit" class="btn btn-primary" name="sale_report" value="SHOW">
							<input type="hidden" name="submit" value="saleReport" />
						</div>
					</td>
										</tr>
									</tbody>
								</table>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-heading">Requested Reports: &nbsp;<i class="text-primary">Department: &nbsp;<?= $dept; ?>&nbsp;&nbsp;Year: &nbsp;<?= $year; ?> &nbsp; &nbsp;
									</i></div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>Sl No</th>
                                        <th>Employee Code</th>
                                        <th>Employee name</th>
                                        <th>Designation</th>
                                        <th>Department</th>
                                        <th>Year</th>
                                        <th>CL</th>
                                        <th>EL</th>
                                        <th>SPL</th>
                                        <th>Total Leave</th>
								</thead>
								<tbody>
									<?php
										$sl = 0;$ttotal = 0;
										$tdata = $db->query("SELECT * FROM  employee WHERE e_department = '$dept'");
										$rowCount = $tdata->num_rows;
										if(empty($rowCount)){
											$rowCount = 0;
										}
										while ($value = $tdata->fetch_object()) {
										$sl++;
										$emp = $value->e_id;
									?>
										<tr>
											<td><?= $sl; ?></td>
                                            <td>
												<?php
													echo $value->e_code;
												?>
											</td>
                                            <td>
												<?php
													echo $value->e_name;
												?>
											</td>
                                            <td>
												<?php
													$desig = $value->e_designation; 
													$sqld = $db->query("select * from designation where ds_id='$desig' ");
													$queryd = $sqld->fetch_object();
													echo $queryd->ds_name;
												?>
											</td>
                                            <td>
												<?php
													$dept = $value->e_department; 
													$sqls = $db->query("select * from department where d_id='$dept' ");
													$querys = $sqls->fetch_object();
													echo $querys->d_name;
												?>
											</td>
											<td><?= $year; ?></td>
										<td><a href="#" data-toggle="modal" data-target="#myModalcl<?= $sl; ?>">
											<?php
											$tdatap = $db->query("SELECT * FROM attendance  WHERE YEAR(ea_date) = '$year'  AND ea_employee = '$emp' AND ea_reason = 'CL'");
											echo $rowCountp = $tdatap->num_rows;
											?></a>
		<div class="modal fade" id="myModalcl<?= $sl; ?>" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">CL Leave Dates :</h4>
					</div>
				<div class="modal-body" style="padding-bottom:100px;">
				<table class="table table-striped table-bordered table-hover">
					<!-- <thead>
						<tr>
							<td>Leave Dates :</td>
						</tr>
					</thead> -->
				<tbody>
				<?php
				$query = $db->query("SELECT * FROM attendance  WHERE YEAR(ea_date) = '$year'  AND ea_employee = '$emp' AND ea_reason = 'CL'");
				while($rowc = $query->fetch_object()){
				?>
					<tr>
						<td><?= $rowc->ea_date; ?></td>
					</tr>
					<?php } ?>
				</tbody>
				</table>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
										</td>
										<td><a href="#" data-toggle="modal" data-target="#myModalel<?= $sl; ?>">
										<?php
										$tdataa = $db->query("SELECT * FROM attendance  WHERE YEAR(ea_date) = '$year' AND ea_employee = '$emp' AND ea_astatus = 'EL'");
										echo $rowCounta = $tdataa->num_rows;
										?></a>
			<div class="modal fade" id="myModalel<?= $sl; ?>" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">EL Leave Dates :</h4>
					</div>
				<div class="modal-body" style="padding-bottom:100px;">
				<table class="table table-striped table-bordered table-hover">
					<!-- <thead>
						<tr>
							<td>Leave Dates :</td>
						</tr>
					</thead> -->
				<tbody>
				<?php
				$query = $db->query("SELECT * FROM attendance  WHERE YEAR(ea_date) = '$year'  AND ea_employee = '$emp' AND ea_reason = 'EL'");
				while($rowc = $query->fetch_object()){
				?>
					<tr>
						<td><?= $rowc->ea_date; ?></td>
					</tr>
					<?php } ?>
				</tbody>
				</table>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
										</td>
										<td><a href="#" data-toggle="modal" data-target="#myModalspl<?= $sl; ?>">
										<?php
										$tdatal = $db->query("SELECT * FROM attendance  WHERE YEAR(ea_date) = '$year' AND ea_employee = '$emp' AND ea_astatus = 'SPL'");
										echo $rowCountl = $tdatal->num_rows;
										?></a>
			<div class="modal fade" id="myModalspl<?= $sl; ?>" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">SPL</h4>
					</div>
				<div class="modal-body" style="padding-bottom:100px;">
				<table class="table table-striped table-bordered table-hover">
					<!-- <thead>
						<tr>
							<td>Leave Dates :</td>
						</tr>
					</thead> -->
				<tbody>
				<?php
				$query = $db->query("SELECT * FROM attendance  WHERE YEAR(ea_date) = '$year'  AND ea_employee = '$emp' AND ea_reason = 'SPL'");
				while($rowc = $query->fetch_object()){
				?>
					<tr>
						<td><?= $rowc->ea_date; ?></td>
					</tr>
					<?php } ?>
				</tbody>
				</table>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
										</td>
										<td>
										<?php
										echo $tleave = $rowCountl+$rowCounta+ $rowCountp;
										?>
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
		<script>
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
		</script>
	<?php include_once 'footer.php'; ?>	