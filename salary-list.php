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
if(!empty($_REQUEST['year'])){
	$year = mysqli_real_escape_string($db, $_REQUEST['year']);	
}else{
	$year = '';
}
if(!empty($_REQUEST['month'])){
	$months = mysqli_real_escape_string($db, $_REQUEST['month']);
}else{
	$months = '';
}	
if(!empty($_REQUEST['dept'])){
	$dept = mysqli_real_escape_string($db, $_REQUEST['dept']);	
}else{
	$dept = '';
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
		<title>Employee Salary </title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
			th,td { text-align:center;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info"> Salary List</h2>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-heading">Requested Reports &nbsp;<i class="text-primary">  </i></div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<!-- <th>Sl No</th>
                                        <th>Department</th>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Salary Month</th>
										<th>Circle</th>
                                        <th>Location</th>
                                        <th>Designation</th>
                                        <th>Job Category</th>
                                        <th>DOB</th>
                                        <th>DOJ</th>
                                        <th>Father's name</th>
                                        <th>Address</th>
                                        <th>bank details</th>
                                        <th>EPF/UAN</th>
                                        <th>ESIC NO</th>
                                        <th>Attendance</th>
                                     
										<th>View</th> -->

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
                                        <th>EPF Deduction</th>
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
										if(!empty($year)&&($months)&&($dept)){
										$tdata = $db->query("SELECT * FROM salary JOIN employee ON salary.es_employee= employee.e_id WHERE es_year = '$year' AND es_month = '$months' AND es_department = '$dept' ");
										}else{
											$tdata = $db->query("SELECT * FROM salary JOIN employee ON salary.es_employee= employee.e_id ");
										}
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
											  <?php if(($value->es_month) == 1){ echo 'January';}
													if(($value->es_month) == 2){ echo 'February';}
													if(($value->es_month) == 3){ echo 'march';}
													if(($value->es_month) == 4){ echo 'April';}
													if(($value->es_month) == 5){ echo 'May';}
													if(($value->es_month) == 6){ echo 'June';}
													if(($value->es_month) == 7){ echo 'July';}
													if(($value->es_month) == 8){ echo 'August';}
													if(($value->es_month) == 9){ echo 'September';}
													if(($value->es_month) ==10){ echo 'October';}
													if(($value->es_month) == 11){ echo 'November';}
													if(($value->es_month) == 12){ echo 'December';} ?>
												</td>
										<td><?= $value->es_year; ?></td>
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
										<td><?= round($value->es_fepf); ?></td>	
										<td><?= round($value->es_fesic); ?></td>	
										<td><?= round($value->es_fit); ?></td>	
										<td><?= round($value->es_fptax); ?></td>	
										<td><?= round($value->es_fother); ?></td>	
										<td><?= round($value->es_tdeduction); ?></td>
										<td><?= round($value->es_fnsalary); ?></td>	
										<td>	
											<?php 
											
										if(!empty($year)&&($months)&&($dept)){
											?>	
												<a href="view_salary_slip?e_id=<?= $value->e_id; ?>&year=<?= $year;?>&month=<?= $months; ?>" class="btn btn-primary btn-xs"><i class="fa fa-gear fa-fw"></i>Salary Slip</a>
												<?php }else{?>
												<a href="view_salary_slip?e_id=<?= $value->e_id; ?>&year=<?= $value->es_year; ?>&month=<?= $value->es_month; ?>" class="btn btn-primary btn-xs"><i class="fa fa-gear fa-fw"></i>Salary Slip</a>
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