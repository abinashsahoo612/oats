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

$FromDate = $ToDate = date('Y-m-d');$dept = '';
if ($_POST && $_POST['submit'] == 'saleReport') {
	$dept = mysqli_real_escape_string($db, $_REQUEST['department']);	
	$ToDate = mysqli_real_escape_string($db, $_REQUEST['ToDate']);	
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
		<title> Attendance Report</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
			th,td { text-align:center;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Attendance Reports</h2>
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
													<label for="ToDate"> Date:</label>
													<input type="text" class="form-control" placeholder="YYYY-MM-DD" id="tdate" name="ToDate" value="" required>
												</div>
											</td>
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
						<div class="panel-heading">Requested Reports &nbsp;<i class="text-primary"> <?= $ToDate ?></i></div>
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
									</tr>
								</thead>
								<tbody>
									<?php
										$sl = 0;$ttotal = 0;

										$tdataa = $db->query("SELECT * FROM  attendance where ea_department = '$dept' AND ea_date = '$ToDate' AND ea_status = '1'");
										while ($valuea = $tdataa->fetch_object()) {
										$sl++;
										?>
										<tr>
											<td><?= $sl; ?></td>
                                            <td>
												<?php
													$dept=$valuea->ea_department; 
													$sql = $db->query("select * from department where d_id='$dept' ");
													$query = $sql->fetch_object();
													echo $query->d_name;
												?>
                                            <td>
												<?php
													$emp=$valuea->ea_employee; 
													$tdata = $db->query("SELECT * FROM employee where  e_id = '$emp'");
													$value = $tdata->fetch_object();
													echo $emp = $value->e_name; 
													// $sql = $db->query("select * from employee where e_id='$emp' ");
													// $query = $sql->fetch_object();
													//echo $query->ea_employee;
												?>
											</td>
                                            <td><?= mysqlToFormat($ToDate,'d-m-Y'); ?></td>
                                            <td>
											<?php 
												$emp = $value->e_id;
												//$date = $value->ea_date;
												$tdataa = $db->query("SELECT * FROM  attendance where ea_employee = '$emp' AND ea_date = '$ToDate' AND ea_status = '1'");
												$valuea = $tdataa->fetch_object();
											?>
											<?php 
											$status = $valuea->ea_astatus; 
											if($status == 'P'){
												echo 'Present';
											}else if ($status == 'A'){
												echo $valuea->ea_reason;
											}else if ($status == 'L'){
												echo $valuea->ea_reason;
											}else if ($status == 'H'){
												echo $valuea->ea_reason;
											}else if ($status == 'O'){
												echo 'Sunday';
											}
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