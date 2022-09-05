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

if (empty($_REQUEST['e_id'])) {
	$emp_id = '0';
} else {
	$emp_id = $_REQUEST['e_id'];
}
if (empty($_REQUEST['month'])) {
	$month = '0';
} else {
	$month = $_REQUEST['month'];
}

if (empty($_REQUEST['year'])) {
	$year = '0';
} else {
	$year = $_REQUEST['year'];
}
$tearnings = 0;$tdeduction = 0;
$results = $db->query("SELECT * FROM salary WHERE es_employee = '$emp_id' AND es_month = '$month'AND es_year = '$year'");
$row = $results->fetch_object();
if(empty($row->es_id)) {
	$_SESSION['msg'] = md5('11');
	header("Location: add-emp-salary?msg=" . md5('11') . "");
}
	
	$queryp = $db->query("SELECT * FROM employee  WHERE e_id = '$emp_id'");
	$valuep = $queryp->fetch_object();
	
	$datam = $db->query( "SELECT * FROM `month` WHERE m_month = '$month' " );
	$valuem = $datam->fetch_object();
//	$tdeduction = ( $valuep->e_epfamount)+($valuep->e_esicamount)+($valuep->e_it)+($valuep->e_ptax)+($valuep->e_other)+(round($row->es_ldeduction));

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>OATS | View Salary Slip</title>
    <?php include_once 'header.php'; ?>
    <style>
      .container-fixed {
        margin: 0 auto;
       max-width: 550px;
        font-size:12px;
      }
      .panel {
        border:none;
      }
      .no-sort::after { display: none!important;}
	  #showFormat{border:0px dotted #ffffff;}
	  /*#bill_part td{border: 1.5px solid #000000!important;}*/
	  #product_table td, 
        th{border-left: 1.5px solid #000000!important;border-right: 1.5px solid #000000!important;}
	  #product_table{border: 2px solid #000000!important;margin-top:-2px!important;}
	  .cancelled{background-image: url(dist/images/cancelled.png);background-repeat: no-repeat;background-position: center;}
    </style>
  <div id="page-wrapper">
    <?php include_once 'msg.php'; ?>
    <div class="row">
      <div class="col-lg-12 text-center">
        <h3 class="page-header text-info">Pay Slip for the Month Of 
											  <?php if($month == 1){ echo 'January';}
													if($month == 2){ echo 'February';}
													if($month == 3){ echo 'march';}
													if($month == 4){ echo 'April';}
													if($month == 5){ echo 'May';}
													if($month == 6){ echo 'June';}
													if($month == 7){ echo 'July';}
													if($month == 8){ echo 'August';}
													if($month == 9){ echo 'September';}
													if($month ==10){ echo 'October';}
													if($month == 11){ echo 'November';}
													if($month == 12){ echo 'December';} ?>,<?= $year; ?></h3>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="col-lg-12 col-md-12 col-xs-12">
          <div class="panel panel-default" style="border:none;">
			<div class="panel-body">
				
			<div id="bill_part" class="row">
				<div class="col-lg-12 text-center"  style="border:1.5px solid #000000;height:90px;">
						<div style="letter-spacing:0.2px;">
							<b style="font-size:15px;letter-spacing:1px;margin-bottom:1px;color:#000000;">
							M/s Odyssey Advanced Telematics Systems<br> Office No-4&5,4th Floor,Block-II,<br>BMC Bhawani Commercial Enclave,<br> Saheed Nagar, Bhubaneswar-751007,Odisha
						</b>
					</div>
                 </div>

				<div id="bill_part" class="row" style="">
					<div class="col-md-6 col-sm-6 col-xs-12" style="border:1.5px solid #000000;height:100px;">
						<div style="letter-spacing:0.2px;">
							
							<b style="letter-spacing:0.2px;line-height:20px;color:#000000;">
							Salary For Month:  <?php if($month == 1){ echo 'January';}
													if($month == 2){ echo 'February';}
													if($month == 3){ echo 'march';}
													if($month == 4){ echo 'April';}
													if($month == 5){ echo 'May';}
													if($month == 6){ echo 'June';}
													if($month == 7){ echo 'July';}
													if($month == 8){ echo 'August';}
													if($month == 9){ echo 'September';}
													if($month ==10){ echo 'October';}
													if($month == 11){ echo 'November';}
													if($month == 12){ echo 'December';} ?>,<?= $year; ?>,<br/>
							EPF/UAN NO : <?= $valuep->e_epf; ?><br/>
							ESIC NO : <?= $valuep->e_esicno; ?><br/>
							Days Of This Month  : <?= $valuem->m_days; ?><br/>
							Present Days : <?= $row->es_days; ?><br/>
						</b>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12" style="border: 1.5px solid #000000;height:100px;">
					<div style="letter-spacing:0.2px;">
							
							<b style="letter-spacing:0.2px;line-height:20px;color:#000000;">
							Employee Name: <?= $valuep->e_name; ?><br/>
							Employee ID: <?= $valuep->e_code; ?><br/>
							Father's Name : <?= $valuep->e_fname; ?><br/>
							Department: <?php // $valuep->e_department; ?><?php
												$d_id = $valuep->e_department;
												$sqld = $db->query("select * from department WHERE d_id = '$d_id'");
												if((mysqli_num_rows($sqld)) > 0) {
												$queryd = $sqld->fetch_object();
												echo $queryd->d_name;
												}
										?><br/>
							designation : <?php //$valuep->e_designation; ?><?php
												$ds_id = $valuep->e_designation;
												$sqlds = $db->query("select * from designation WHERE ds_id = '$ds_id'");
												if((mysqli_num_rows($sqlds)) > 0) {
												$queryds = $sqlds->fetch_object();
												echo $queryds->ds_name;
												}
										?><br/>
						</b>
						</div>
					</div>
				</div>
				<div class="row" style="margin-bottom:5px;min-height:100px;" >
				<div class="col-md-6 col-sm-6 col-xs-12" style="">
					<table id="product_table" width="100%" class="table-condensed">
						<tr style="border-bottom:2px solid #999797;">
							<th class="text-center">Earnings</th>
							<th class="text-center">Amount</th>
						</tr>
						<tr>
						<th class="">Basic Salary</th>
						<td class="text-center"><?= round($row->es_nbasic); ?></td>
						</tr>
						<tr>
						<th class="">DA </th>
						<td class="text-center"><?= round($row->es_nda); ?></td>
						</tr>
						<tr>
						<th class="">HRA</th>
						<td class="text-center"><?= round($row->es_nhra); ?></td>
						</tr>
						<tr>
						<th class="">Other Allowance</th>
						<td class="text-center"><?= round($row->es_nallowance); ?></td>
						</tr>
						<tr>
						<th class="">Other Special Allowance</th>
						<td class="text-center"><?= round($row->es_nsallowance); ?></td>
						</tr>
						<tr>
						<th class="">Gross Salary</th>
						<td class="text-center"><?= round($row->es_ngsalary); ?></td>
						</tr>
					
					
					</table>
				</div>
				
				<div class="col-md-6 col-sm-6 col-xs-12" style="">

				<table id="product_table" width="100%" class="table-condensed">
						<tr style="border-bottom:2px solid #999797;">
							<th class="text-center">Deductions</th>
							<th class="text-center">Amount</th>
						</tr>
						<tr>
						<th class="">EPF</th>
						<td class="text-center"><?= round($row->es_fepf); ?></td>
						</tr>
						<tr>
						<th class="">ESIC </th>
						<td class="text-center"><?= round($row->es_fesic); ?></td>
						</tr>
						<tr>
						<th class="">IT</th>
						<td class="text-center"><?= round($row->es_fit); ?></td>
						</tr>
						<tr>
						<th class="">Proffesional Tax</th>
						<td class="text-center"><?= round($row->es_fptax); ?></td>
						</tr>
						<tr>
						<th class="">Other </th>
						<td class="text-center"><?= round($row->es_fother); ?></td>
						</tr>
						<th></th>
						<td></td>
						<tr>
						<th class=""></th>
						<td class="text-center"></td>
						</tr>
					</table>
				</div>
				</div>	
				
				<div class="row" >
				<table id="product_table" width="100%" class="table-condensed">
						<tr style="border-bottom:2px solid #999797;">
							<th class="">Total earnings</th>
							<th class=""><?= round($row->es_ngsalary); ?></th>
							<th class="">Total Deduction</th>
							<th class=""><?= round($row->es_tdeduction) ; ?></th>
						</tr>
				</table>
				</div>		

				<div class="row" >
						<div style="border: 1.5px solid #000000;" >
							<b style="font-size:15px;letter-spacing:1px;margin-bottom:1px;color:#000000;text-align:center;">Net Salary:&nbsp;&nbsp;&nbsp;&nbsp;<?= round($row->es_fnsalary); ?>/-&nbsp;&nbsp;&nbsp;Rupees(<?php echo convert_number_to_words(round($row->es_fnsalary)); ?>)only</b>
				</div>		

				<div class="row" style="margin-top:30px; border-top:2px solid #0A5993;">
					<div class="col-md-12 col-sm-12 col-xs-12 text-center">
						<a href="print_salary_slip?e_id=<?= $emp_id;?>&month=<?= $month;?>&year=<?= $year;?>" target="__blank" type="button" class="btn btn-info btn-xs" title="Print"><span class="glyphicon glyphicon-print"></span> PRINT</a>
					</div>
				</div>
			</div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <?php include_once 'footer.php'; ?>