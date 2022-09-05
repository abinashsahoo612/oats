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

$FromDate = $ToDate = date('Y-m-d');$dept = $year = $month = '';
if ($_POST && $_POST['submit'] == 'saleReport') {
	$FromDate = mysqli_real_escape_string($db, $_REQUEST['FromDate']);	
	$ToDate = mysqli_real_escape_string($db, $_REQUEST['ToDate']);	
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
		<title>Monthly Attendance Report</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
			th,td { text-align:center;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Monthly Attendance Reports</h2>
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
											<!-- <td class="col-md-3">
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
											<td class="col-md-3">
												<div class="form-group date">
													<label for="ToDmonthate"> Month:</label>  
													<select name="month" id="month" class="form-control input-sm">
													<?php
														$month_names = array("January","February","March","April","May","June","July","August","September","October","November","December");
														foreach($month_names as $month)
														{
														?>
														<option value="<?php echo $month; ?>"><?php echo $month; ?></option>
														<?php 
														}
														?>
												</select>
												</div>
											</td> -->
											
											<td class="col-md-3">
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
						<div class="panel-heading">Requested Reports: &nbsp;<i class="text-primary">From: &nbsp;<?= $FromDate; ?> &nbsp; &nbsp;To: &nbsp;<?= $ToDate; ?></i></div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>Sl No</th>
                                        <th>Department</th>
                                        <th>Employee</th>
                                        <th>Month</th>
                                        <th>Present Days</th>
                                        <th>Absent Days</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sl = 0;$ttotal = 0;
										$tdata = $db->query("SELECT * FROM attendance JOIN employee ON attendance.ea_employee= employee.e_id WHERE DATE(ea_date) >= DATE('$FromDate') AND DATE(ea_date) <= DATE('$ToDate')  AND ea_department = '$dept'");
										$rowCount = $tdata->num_rows;
										if(empty($rowCount)){
											$rowCount = 0;
										}
										while ($value = $tdata->fetch_object()) {
											$sl++;
										?>
										<tr>
											<td><?= $sl; ?></td>
                                            <td>
												<?php
													$dept = $value->ea_department; 
													$sql = $db->query("select * from department where d_id='$dept' ");
													$query = $sql->fetch_object();
													echo $query->d_name;
												?>
												</td>
                                            <td>
												
												<?php
													$emp = $value->ea_employee; 
													$sql = $db->query("select * from employee where e_id='$emp' ");
													$query = $sql->fetch_object();
													echo $query->e_name;
												?>
											</td>
                                            <td><?=  date_format(date_create($FromDate),"F");?></td>
                                            <td><?php
											$date = date("F", strtotime('$FromDate'));
											$queryd = $db->query("SELECT * FROM `month` WHERE m_month = '$date'");
											$valuem = $queryd->fetch_object();
											$mdays = $valuem->m_days;
											echo $present = $mdays-$rowCount;
											
											?></td>
                                            <td><?= $rowCount; ?></td>
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