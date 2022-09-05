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

$dept = $year = '';$fmonths = $tmonths = '';
if ($_POST && $_POST['submit'] == 'saleReport') {
	$year = mysqli_real_escape_string($db, $_REQUEST['year']);	
	$fmonths = mysqli_real_escape_string($db, $_REQUEST['fmonth']);	
	//$tmonths = mysqli_real_escape_string($db, $_REQUEST['tmonth']);	
	$dept = mysqli_real_escape_string($db, $_REQUEST['department']);	
}


if(!empty($site)){
	$xtra=" AND es_department = '$dept'";
  }else {
	$xtra ='';
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
		<title>Monthly Salary Report</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
			th,td { text-align:center;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Monthly Salary Reports</h2>
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
											<td class="col-md-3">
												<div class="form-group date">
													<label for="month"> Month:</label>  
													<select name="fmonth" id="fmonth" class="form-control input-sm">
													<?php
														$month_names = array("Select Month","January","February","March","April","May","June","July","August","September","October","November","December");
														foreach($month_names as $key => $month)
														{
														?>
														<option value="<?php echo $key; ?>"><?php echo $month; ?></option>
														<?php 
														}
														?>
												</select>
												</div>
											</td>
											<!-- <td class="col-md-3">
												<div class="form-group date">
													<label for="month">To Month:</label>  
													<select name="tmonth" id="tmonth" class="form-control input-sm">
													<?php
														// $month_names = array("January","February","March","April","May","June","July","August","September","October","November","December");
														// foreach($month_names as $key => $month)
														// {
														?>
														<option value="<?php echo $key; ?>"><?php echo $month; ?></option>
														<?php 
														//}
														?>
												</select>
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
						<div class="panel-heading">Requested Reports &nbsp;<i class="text-primary">  <?= $fmonths; ?>&nbsp;&nbsp;,<?= $year; ?></i></div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>Sl No</th>
                                        <th>Circle</th>
                                        <th>Location</th>
                                        <th>month</th>
                                        <th>Year</th>
                                        <th>Department</th>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Father's Name</th>
                                        <th>Gender </th>
                                        <th>Blood Group</th>
                                        <th>Contact No</th>
                                        <th>ALternate Contact No</th>
                                        <th>Email ID</th>
                                        <th>Present Address</th>
                                        <th>Permanent Address</th>
                                        <th>Bank details</th>
                                        <th>Designation</th>
                                        <th>Job Category</th>
                                        <th>ESIC NO</th>
                                        <th>EPF/UAN</th>
                                        <th>DOB</th>
                                        <th>DOJ</th>
                                        <th>Basic salary</th>
                                        <th>DA</th>
                                        <th>HRA</th>
                                        <th>Other Allowance</th>
                                        <th>Other Special Allowance</th>
                                        <th>Gross salary</th>
                                        <th>Attendance</th>
                                        <th>Net Basic salary</th>
                                        <th>Net DA</th>
                                        <th>Net HRA</th>
                                        <th>Net Other Allowance</th>
                                        <th>Net Other Special Allowance</th>
                                        <th>Net Gross salary</th>
                                        <th>EPF Applicable</th>
                                        <th>EPF Deduction</th>
                                        <th>ESIC Applicable</th>
                                        <th>ESIC deduction</th>
                                        <th>IT Deduction</th>
                                        <th>P.tax Deduction</th>
                                        <th>Other Deduction</th>
                                        <th>Total Deduction</th>
                                        <th>Net salary</th>
										<th>View</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sl = 0;
										$tdata = $db->query("SELECT * FROM salary JOIN employee ON salary.es_employee= employee.e_id WHERE es_year = '$year' AND es_month = '$fmonths' ");
										while ($value = $tdata->fetch_object()) {
										$sl++;
									?>
										<tr>
											<td><?= $sl; ?></td>
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
										<td>
											  <?php if($fmonths == 1){ echo 'January';}
													if($fmonths == 2){ echo 'February';}
													if($fmonths == 3){ echo 'march';}
													if($fmonths == 4){ echo 'April';}
													if($fmonths == 5){ echo 'May';}
													if($fmonths == 6){ echo 'June';}
													if($fmonths == 7){ echo 'July';}
													if($fmonths == 8){ echo 'August';}
													if($fmonths == 9){ echo 'September';}
													if($fmonths ==10){ echo 'October';}
													if($fmonths == 11){ echo 'November';}
													if($fmonths == 12){ echo 'December';} ?>
												</td>
										<td><?= $year; ?></td>
                                            <td>
												<?php
													$dept = $value->es_department; 
													$sql = $db->query("select * from department where d_id='$dept' ");
													$query = $sql->fetch_object();
													echo $query->d_name;
												?>
												</td>
                                            <td><?= $value->e_code; ?></td>
											<td><?= $value->e_name; ?></td>	
											<td><?= $value->e_fname; ?></td>	
											<td><?= $value->e_gender; ?></td>	
											<td><?= $value->e_bgroup; ?></td>
											<td><?= $value->e_contact; ?></td>	
											<td><?= $value->e_acontact; ?></td>	
											<td><?= $value->e_email; ?></td>
											<td><?= $value->e_addr; ?></td>		
											<td><?= $value->e_paddr; ?></td>
											<td><?= $value->e_bdetails; ?></td>	
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
										<td><?= $value->e_bsalary; ?></td>	
										<td><?= $value->e_da; ?></td>	
										<td><?= $value->e_hra; ?></td>	
										<td><?= $value->e_allowance; ?></td>
										<td><?= $value->e_sallowance; ?></td>	
										<td><?= $value->e_gsalary; ?></td>
										<td><?= $value->es_days; ?></td>
										<td><?= round($value->es_nbasic); ?></td>	
										<td><?= round($value->es_nda); ?></td>
										<td><?= round($value->es_nhra); ?></td>	
										<td><?= round($value->es_nallowance); ?></td>	
										<td><?= round($value->es_nsallowance); ?></td>
										<td><?= round($value->es_ngsalary); ?></td>	
										<td></td>	
										<td><?= round($value->es_fepf); ?></td>	
										<td></td>	
										<td><?= round($value->es_fesic); ?></td>	
										<td><?= round($value->es_fit); ?></td>	
										<td><?= round($value->es_fptax); ?></td>	
										<td><?= round($value->es_fother); ?></td>	
										<td><?= round($value->es_tdeduction); ?></td>
										<td><?= round($value->es_fnsalary); ?></td>		
										<td>		
												<a href="view_salary_slip?e_id=<?= $value->e_id; ?>&year=<?= $year;?>&month=<?= $fmonths; ?>" class="btn btn-primary btn-xs"><i class="fa fa-gear fa-fw"></i>Salary Slip</a>
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