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

	
if (!empty( $_REQUEST['e_id'] )) {
	$emp = $_REQUEST['e_id'];	
}else {
  $emp = '';
}



$dept = $year = $months ='';$ea_date = date('Y-m-d');
if(!empty($_REQUEST['submit'])){
if ($_REQUEST && $_REQUEST['submit'] == 'getemployees') {
	$dept = mysqli_real_escape_string($db, $_REQUEST['es_department']);	
	$year = mysqli_real_escape_string($db, $_REQUEST['es_year']);	
	$months = mysqli_real_escape_string($db, $_REQUEST['es_month']);	
}}else{
	$dept = '';	
	$year = '';	
	$months = '';	

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
		<title>Employee Salary</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Employee Salary </h2>
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
          $results = $db->query("SELECT * FROM salary WHERE es_employee = '$e_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="" enctype="multipart/form-data" method="post" >
		<div class="col-lg-4 col-md-4 col-xs-12">
		  <div class="form-group">
				<label>Select Department </label>
				<select name="es_department" id="es_department" class="form-control input-sm" required>
					<option value="">Select Department</option>
					<?php
						$sql = $db->query("select * from department ");
						if (mysqli_num_rows($sql) > 0) {
							while ($query = $sql->fetch_object()) {
							?>
							
							<option <?php
								if (!empty($_REQUEST['e_id'])) {
									if ($row->es_department === $query->d_id) {
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
            </div>


		
			
		<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label>Year:</label> 
			  	<?php
					$currently_selected = date('Y'); 
					$earliest_year = 1950; 
					$latest_year = date('Y'); 

					print '<select name="es_year" id="year" class="form-control input-sm">';
					foreach ( range( $latest_year, $earliest_year ) as $i ) {
						print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
					}
					print '</select>';
				?>
            </div>
				</div>


			
		<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label>Month:</label> 
				<select name="es_month" id="es_month" class="form-control input-sm">
				<?php
					$month_names = array("Select Month","January","February","March","April","May","June","July","August","September","October","November","December");
					foreach($month_names as $key => $month)
					{
					?>
					<option  value="<?php echo $key; ?>"><?php echo $month; ?></option>
					<?php 
					}
					?>
			</select>
            </div>
			</div>
		<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <input type="submit" name="submitf" id="submit" value="Get Employees" class="btn btn-primary">
                <input type="hidden" name="submit" value="getemployees" />
            </div>
            </div>

          </form>
        </div>
		
	</div>
</div>

<!-- 
<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-heading">
					</div>
						<div class="panel-body">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>Sl No</th>
                                        <th>Department</th>
                                        <th>Employee</th>
                                        <th>Year.</th>
                                        <th>Month.</th>
                                        <th>Present days</th>
                                        <th>Absent days</th>
                                        <th>Per day salary</th>
                                        <th>Leave Deduction</th>
                                        <th>Salary Payble</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$sl = 0;
										$tdata = $db->query("SELECT * FROM  salary where es_employee = '$emp'");
										while ($value = $tdata->fetch_object()) {
											$sl++;
										?>
										<tr>
											<td><?= $sl; ?></td>
                                            <td>
												<?php
													$dept = $value->es_department; 
													$sql = $db->query("select * from department where d_id='$dept' ");
													$query = $sql->fetch_object();
													echo $query->d_name;
												?>
												</td>
                                            <td>
												<?php
													$emp = $value->es_employee; 
													$sql = $db->query("select * from employee where e_id='$emp' ");
													$query = $sql->fetch_object();
													echo $query->e_name;
												?>
												</td>
                                            <td><?=  $value->es_year ;	?></td>
                                            <td><?=  $value->es_month; 	?></td>
                                            <td><?=  $value->es_days; 	?></td>
                                            <td><?=  $value->es_abdays; 	?></td>
                                            <td><?=  $value->es_pdaysalary; 	?></td>
                                            <td><?=  $value->es_ldeduction; 	?></td>
                                            <td><?=  $value->es_psalary; 	?></td>
										<td>
													
												<a href="?e_id=<?= $value->es_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
													
												<a href="view_salary_slip?e_id=<?= $value->es_id; ?>&month=<?=  $value->es_month ;?>&year=<?=  $value->es_year; ?>" class="btn btn-primary btn-xs">Salary Slip</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div> -->


				
		<form name="frm" id="frm" action="pages/action-emp-salary.php" enctype="multipart/form-data" method="post" >
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
										<th><?= $dept; ?></th>
										<th><input type="checkbox" id="checkAll" name=>Select All</th>
                                        <th>Department</th>
                                        <th>Employee</th>
                                        <th>Year.</th>
                                        <th>Month.</th>
                                        <!-- <th>Absent days</th> -->
                                        <!-- <th>Attendance Not Submitted</th> -->
                                        <th>Basic salary</th>
										<th>DA</th>
										<th>HRA</th>
										<th>Other Allowance</th>
										<th>Other Special Allowance</th>
										<th>Gross Salary</th>
                                        <th>Attendance</th>
                                        <th>Net Basic </th>
										<th>Net DA</th>
										<th>Net HRA</th>
										<th>Net Other Allowance</th>
										<th>Net Other Special Allowance</th>
										<th>Net Gross Salary</th>
										<th>EPF Deduction</th>
										<th>Esic Deduction</th>
										<th>IT</th>
										<th>Proffessional tax</th>
										<th>Other Deduction</th>
										<th>Total Deduction</th>
										<th>Net Salary</th>
							</tr>
							</thead>
							<tbody>
	<?php
		$sl = 0;
		// $tdata = $db->query("SELECT * FROM  salary where es_employee = '$emp'");

										
	$tdatae = $db->query("SELECT * FROM  employee where e_department = '$dept' AND e_status = '1'");
	while ($valuee = $tdatae->fetch_object()) {
	$spid = $valuee->e_id;
											
	// $query = $db->query("SELECT * FROM attendance  WHERE ea_employee = '$spid' AND MONTH(ea_date) = '$months' AND DATE_FORMAT(ea_date, '%Y') = '$year' ");
	// //Count total number of rows
	// $rowCount = $query->num_rows;
	//$rowCount = mysqli_num_rows($query)
										
	$queryh = $db->query("SELECT * FROM holidaydetails  WHERE MONTH(hd_date) = '$months' AND DATE_FORMAT(hd_date, '%Y') = '$year' AND hd_status = '1' ");
	$rowCounth = $queryh->num_rows;
	if(empty($rowCounth)){
		$rowCounth = 0;
	}
	// $tsubmitted = $rowCount+$rowCounth;

	//Month Days
	$datam = $db->query( "SELECT * FROM `month` WHERE m_month = '$months' " );
	$valuem = $datam->fetch_object();
	 $mdays = $valuem->m_days;
	//$notsubmitted = $mdays-$tsubmitted;

				
	//Display present						
	$queryp = $db->query("SELECT * FROM attendance  WHERE ea_employee = '$spid' AND MONTH(ea_date) = '$months' AND DATE_FORMAT(ea_date, '%Y') = '$year' AND ea_astatus ='P'");
	$rowCountp = $queryp->num_rows;
	$present = $rowCountp+$rowCounth;
			
	//Display absent							
	// $query = $db->query("SELECT * FROM attendance  WHERE ea_employee = '$spid' AND MONTH(ea_date) = '$months' AND DATE_FORMAT(ea_date, '%Y') = '$year' AND ea_astatus ='A' 
	// ");
	// $rowCountA = $query->num_rows;
	//$absent = $rowCountA+$notsubmitted;
	//$absent = $mdays-$present;

	//pdaysalary calculates
	
	$queryp = $db->query("SELECT * FROM employee  WHERE e_id = '$spid'");
	$valuep = $queryp->fetch_object();
	$bsalary = $valuep->e_bsalary;
	$gsalary = $valuep->e_gsalary;
	$nsalary = $valuep->e_nsalary;
	$da = $valuep->e_da;
	$hra = $valuep->e_hra;
	$allowance = $valuep->e_allowance;
	$sallowance = $valuep->e_sallowance;

//net gross salary
	$nbasic = ($bsalary/$mdays)*$present;
	$nda = ($da/$mdays)*$present;
	$nhra = ($hra/$mdays)*$present;
	$nallowance = ($allowance/$mdays)*$present;
	$nsallowance = ($sallowance/$mdays)*$present;

	$tallowance = $nda + $nhra + $nallowance + $nsallowance;
	$ngsalary = $nbasic + $tallowance ;

	//net salary
	$resulte = $db->query("SELECT * FROM salryamount");
	while($rowe = $resulte->fetch_object()){
	if(($rowe->se_type ==  'EPF')){
	$epf =  $rowe->se_percentage;
	}
	if(($rowe->se_type ==  'ESIC')){
	$esic =  $rowe->se_percentage;
	}

  }
	if(($valuep->e_jobcat) == 'P'){
		$fepf = $ngsalnbasicary *  ($epf/100);
		$fesic = $nbasic * ($esic/100);
	}else{
		$fepf = 0;
		$fesic = 0;

	}
	$fit = $valuep->e_it;
	$fptax = $valuep->e_ptax;
	$fother = $valuep->e_other;
	$tdeduction = $fepf  + $fesic + $fit + $fptax + $fother;
	$fnsalary = $ngsalary - $tdeduction;

	// $pdaysalary = $gsalary/$mdays;
	//  $ldeduction = $pdaysalary*$absent;
	//  $psalary = $nsalary - $ldeduction;
	// $psalary = $pdaysalary * $present;
	// $array['pdaysalary'] = $pdaysalary;
	// $array['ldeduction'] = $ldeduction;
	// $array['psalary'] = $psalary;
		$sl++;
	?>

	<?php
		$tdata = $db->query("SELECT * FROM  salary where es_employee = '$spid' AND es_year = '$year' AND es_month= '$months'");
		$count = mysqli_num_rows($tdata);
	?>
							<tr <?php if ($count > 0) { echo 'style="color: #999;"'; } ?>>
							<td></td>

								<td> <?php if ($count > 0) { ?>
									
									 <input type="" name="" value="paid" disabled class="btn btn-sm btn-success">
									 <?php } else{ ?>
									
										<input type="checkbox" name="empcheck[]" value="emp<?= $spid; ?>" ><?php } ?>
									</td>
							<td class="">
									
									<?php
												$sqld = $db->query("select * from department WHERE d_id = '$dept'");
												if((mysqli_num_rows($sqld)) > 0) {
												$queryd = $sqld->fetch_object();
												echo $queryd->d_name;
												}
									?>
							</td>
							<td class="">
									<?php
												$sqle = $db->query("select * from employee WHERE e_id = '$spid'");
												if((mysqli_num_rows($sqle)) > 0) {
												$querye = $sqle->fetch_object();
												echo $querye->e_name;
												}
										?>
							</td>
								<td class=""><?= $year; ?></td>
								<td class="">
											  <?php if($months == 1){ echo 'January';}
													if($months == 2){ echo 'February';}
													if($months == 3){ echo 'march';}
													if($months == 4){ echo 'April';}
													if($months == 5){ echo 'May';}
													if($months == 6){ echo 'June';}
													if($months == 7){ echo 'July';}
													if($months == 8){ echo 'August';}
													if($months == 9){ echo 'September';}
													if($months ==10){ echo 'October';}
													if($months == 11){ echo 'November';}
													if($months == 12){ echo 'December';} ?>
							</td>
								<!-- <td class=""><?= $absent; ?></td> -->
								</td> -->
								<td class=""><?= $bsalary; ?></td>
								<td class=""><?= $da ;?></td>
								<td class=""><?= $hra; ?></td>
								<td class=""><?= $allowance ;?></td>
								<td class=""><?= $sallowance; ?></td>
								<td class=""><?= $gsalary ;?></td>
								<td class=""><?= $present; ?></td>
								<td class=""><?= round($nbasic); ?></td>
								<td class=""><?= round($nda) ;?></td>
								<td class=""><?= round($nhra); ?></td>
								<td class=""><?= round($nallowance) ;?></td>
								<td class=""><?= round($nsallowance); ?></td>
								<td class=""><?= round($ngsalary) ;?></td>
								<td class=""><?= round($fepf); ?></td>
								<td class=""><?= round($fesic) ;?></td>
								<td class=""><?= round($fit) ;?></td>
								<td class=""><?= round($fptax); ?></td>
								<td class=""><?= round($fother) ;?></td>
								<td class=""><?= round($tdeduction); ?></td>
								<td class=""><?= round($fnsalary) ;?></td>
								</tr>
				<?php } ?>
                </tbody>
			</table>
			<table>
				<tbody>
				<tr>
					<td class=" text-center" >
						<input type="submit" class="btn btn-primary" name="submitf" value="Payment Generarte " onClick="return confirm('Are You Sure For Submit??')" />
						<input type="hidden" name="submit" value="addempsalary"/>
						<input type="hidden" name="dept" value="<?= $dept; ?>"/>
						<input type="hidden" name="month" value="<?= $months; ?>"/>
						<input type="hidden" name="year" value="<?= $year; ?>"/>
					</td>
				</tr>
			</tbody>
			</table>

              </form>


			</div>
<!-- /#page-wrapper -->
<?php include_once 'footer.php'; ?>

<script type="text/javascript">
	$( document ).ready( function () {

		
		$('#es_days').keyup(function () {
		pdays = $('#es_days').val();
		pdaysalsry = $('#es_pdaysalary').val();
		payblesalary = pdaysalsry * pdays;
		$('#es_psalary').val(payblesalary.toFixed(2));	
		});


		$( '#es_department' ).on( 'change', function () {
			var productID = $( this ).val();
			if ( productID ) {
				$.ajax( {
					type: 'POST',
					url: 'ajax_employee.php',
					data: 'pid=' + productID,
					success: function ( html ) {
						$( '#es_employee' ).html( html );
					}
				} );
			} else {
				$( '#es_employee' ).html( '<option value="">Choose Departmet First</option>' );
			}
		} );

		
		$('#es_employee').on('change', function () {
			var spID = $(this).val();
			if (spID) {
				$.ajax({
					type: 'POST',
					url: 'ajax_empdetails.php',
					data: 'spID=' + spID,
					dataType: "json",
					success: function (info) {
						if (info != undefined) {
							//$("#es_days").val(info['pdays']);
							$("#es_bsalary").val(info['es_bsalary']);
							$("#es_gsalary").val(info['es_gsalary']);
							$("#es_nsalary").val(info['es_nsalary']);
							//$("#es_pdaysalary").val(info['es_pdaysalary']);
						}
					}
				});
				} 
		});

		
		$('#es_month').on('change', function () {
			var year = $('#year').val();
			var month = $(this).val();
			var spID = $('#es_employee').val();	//alert('absent');
			if (spID) {
				$.ajax({
					type: 'POST',
					url: 'ajax_empattendance.php',
					data: {spID: spID,spyear: year,spmonth: month},
					dataType: "json",
					success: function (info) {
						if (info != undefined) {
							$("#es_days").val(info['present']);
							//$("#es_abdays").val(info['absent']); 
							$("#es_pdaysalary").val(info['pdaysalary']); 
							$("#es_ldeduction").val(info['ldeduction']); 
							$("#es_psalary").val(info['psalary']); 
						
						}
					}
				});
				} else {
				$('#party_id').html('<option value="">Choose Employee First</option>');
			}
		});

		


		
	} );

	
	$("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
	</script>
