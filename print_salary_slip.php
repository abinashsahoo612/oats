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
	$tdeduction = ( $valuep->e_epfamount)+($valuep->e_esicamount)+($valuep->e_it)+($valuep->e_ptax)+($valuep->e_other)+(round($row->es_ldeduction));

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="components/bootstrap/js/bootstrap.min.js"></script>
    <link href="components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
      .container-fixed {
        margin: 0 auto;
       max-width: 550px;
        font-size:12px;
      }
      .panel {
        border:none;
      }
	  #bill_part td{border: 1.5px solid #000000!important;}
	  #product_table td, th{border-left: 1.5px solid #000000!important;border-right: 1.5px solid #000000!important;padding:0px 2px;}
	  #invoice_table td, th{padding:0px 5px;}
	  #product_table{border: 2px solid #000000!important;margin-top:-2px!important;}
	  .cancelled{background-image: url(dist/images/cancelled.png);background-repeat: no-repeat;background-position: center;}
    </style>
</head>
<body>
    <div class="container-fixed">
		<div class="panel panel-default" style="">
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
							Salary For Month: <?= $month; ?><br/>
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
							Department: <?= $valuep->e_department; ?><br/>
							designation : <?= $valuep->e_designation; ?><br/>
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
						<td class="text-center"><?= $valuep->e_bsalary; ?></td>
						</tr>
						<tr>
						<th class="">DA </th>
						<td class="text-center"><?= $valuep->e_da; ?></td>
						</tr>
						<tr>
						<th class="">HRA</th>
						<td class="text-center"><?= $valuep->e_hra; ?></td>
						</tr>
						<tr>
						<th class="">Other Allowance</th>
						<td class="text-center"><?= $valuep->e_allowance; ?></td>
						</tr>
						<tr>
						<th class="">Other Special Allowance</th>
						<td class="text-center"><?= $valuep->e_sallowance; ?></td>
						</tr>
						<tr>
						<th class="">Gross Salary</th>
						<td class="text-center"><?= $valuep->e_gsalary; ?></td>
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
						<td class="text-center"><?= $valuep->e_epfamount; ?></td>
						</tr>
						<tr>
						<th class="">ESIC </th>
						<td class="text-center"><?= $valuep->e_esicamount; ?></td>
						</tr>
						<tr>
						<th class="">IT</th>
						<td class="text-center"><?= $valuep->e_it; ?></td>
						</tr>
						<tr>
						<th class="">Proffesional Tax</th>
						<td class="text-center"><?= $valuep->e_ptax; ?></td>
						</tr>
						<tr>
						<th class="">Other </th>
						<td class="text-center"><?= $valuep->e_other; ?></td>
						</tr>
						<tr>
						<th class="">Leave deduction </th>
						<td class="text-center"><?= round($row->es_ldeduction); ?></td>
						</tr>
					</table>
				</div>
				</div>	
				
				<div class="row" >
				
				<table id="product_table" width="100%" class="table-condensed">
						<tr style="border-bottom:2px solid #999797;">
							<th class="">Total earnings</th>
							<th class=""><?= $valuep->e_gsalary; ?></th>
							<th class="">Total Deduction</th>
							<th class=""><?= round($tdeduction) ; ?></th>
						</tr>
				</table>
				</div>		

				<div class="row" >
						<div style="border: 1.5px solid #000000;" >
							<b style="font-size:15px;letter-spacing:1px;margin-bottom:1px;color:#000000;text-align:center;">Net Salary:&nbsp;&nbsp;&nbsp;&nbsp;<?= round($row->es_psalary); ?>/-&nbsp;&nbsp;&nbsp;Rupees(<?php echo convert_number_to_words(round($row->es_psalary)); ?>)only</b>
				</div>		

			</div>
			</div>
        </div>
        </div>
	<script type="text/javascript">
	  window.print();
	</script>
</body>
</html>