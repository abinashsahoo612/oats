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

$FromDate = $ToDate = date('Y-m-d');$site='';$xtra='';$xtrap ='';
if ($_POST && $_POST['submit'] == 'saleReport') {
  $employee = mysqli_real_escape_string($db, $_REQUEST['employee']);
   $site = mysqli_real_escape_string($db, $_REQUEST['site']);
   $FromDate = mysqli_real_escape_string($db, $_REQUEST['FromDate']);
  $ToDate = mysqli_real_escape_string($db, $_REQUEST['ToDate']);
  //$TaxType = mysqli_real_escape_string($db, $_REQUEST['TaxType']);

  if(!empty($site)){
	$xtra=" AND sr_site='$site'";
  }else {
	$xtra ='';
  }

  if(!empty($employee)){
	$xtrap=" AND sr_employee='$employee'";
  }else {
	$xtrap ='';
  }
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
    <title> Requisition Report</title>
    <?php include_once 'header.php'; ?>
    <style>
      .no-sort::after { display: none!important;}
      th,td { text-align:center;}
    </style>
  <div id="page-wrapper">
    <?php include_once 'msg.php'; ?>
    <div class="row">
      <div class="col-lg-12">
        <h2 class="page-header text-info">Requisition Reports</h2>
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
                        <label for="FromDate">Select Site:</label>
                        <select name="site" id="site" class="form-control input-sm">
							<option value="">Select Site</option>
							<?php
							$sql = $db->query("SELECT * FROM `site`");
							if (mysqli_num_rows($sql) > 0) {
							  while ($query = $sql->fetch_object()) {
								?>
								<option value="<?php echo $query->s_id; ?>"><?php echo $query->s_sitename; ?></option>
								  <?php
								}
							  }
							?>
						  </select>
                      </div>
                    </td>
                    <td class="col-md-3">
                      <div class="form-group date">
                        <label for="FromDate">Select Employee:</label>
                        <select name="employee" id="employee" class="form-control input-sm">
							<option value="">Select Employee</option>
							<?php
							$sql = $db->query("SELECT * FROM `employee` WHERE e_status='1'");
							if (mysqli_num_rows($sql) > 0) {
							  while ($query = $sql->fetch_object()) {
								?>
								<option value="<?php echo $query->e_id; ?>"><?php echo $query->e_name; ?></option>
								  <?php
								}
							  }
							?>
						  </select>
                      </div>
                    </td>
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
            <div class="panel-heading">Requested Reports &nbsp;<?php if(!empty($FromDate)){ ?><i class="text-primary">From:<?= $FromDate ?></i><?php } ?> <i class="text-primary"> to <?= $ToDate ?></i><br>
			<?php if(!empty($site)){ ?>
				Site :&nbsp;<?= $site ?><?php } ?><br>
				<?php if(!empty($employee)){ ?>
				Employee :&nbsp;<?= $employee ?><?php } ?>
		
		</div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
				<tr>
					<th class="no-sort">Sl.</th>
					<th>Site</th>
					<th>Employee</th>
					<th>Date</th>
					<th>Sub Scope</th>
					<th>Requisition For Approval</th>
					<th>Requisition Paid date</th>
					<th>Material perticulars</th>
					<th>Quantity</th>
					<th>UOM</th>
					<th>Unit price</th>
					<th>Total price</th>
					<th>Material Paid date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $sl =0;
                  $data = $db->query( "SELECT * FROM `requisition` where  DATE(sr_rdate) >= DATE('$FromDate') AND DATE(sr_rdate) <= DATE('$ToDate') $xtra $xtrap" );
                  while ( $value = $data->fetch_object() ) {
                  $sl++;
                ?>
					<tr>
          <td><?= $sl; ?></td>
            <td>
						<?php
						if (!empty($value->sr_site)) {
							$sr_site = $value->sr_site;
							$sqlcat = $db->query("SELECT * FROM `site` WHERE s_id = '$sr_site'");
							$pnm = $sqlcat->fetch_object();
							echo $pnm->s_sitename;
						}
						?>
						</td>
									
									<td><?php
											$e_id = $value->sr_employee;
											$sqld = $db->query("select * from employee WHERE e_id = '$e_id'");
											if((mysqli_num_rows($sqld)) > 0) {
											$queryd = $sqld->fetch_object();
											echo $queryd->e_name;
											}
									?></td>	
										<td><?= $value->sr_rdate; ?></td>	
										<td><?= $value->sr_subscope; ?></td>	
										<td><?= $value->sr_rapproval; ?></td>	
										<td><?= $value->sr_rpaiddate; ?></td>	
										<td><?= $value->sr_mparticulars; ?></td>	
										<td><?= $value->sr_quantity; ?></td>
										<td><?= $value->sr_uom; ?></td>
										<td><?= $value->sr_unitprice; ?></td>
										<td><?= $value->sr_totalprice; ?></td>
										<td><?= $value->sr_mpaiddate; ?></td>

					</tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive
  </div>
          <!-- /.panel-body -->
        </div>
      </div>
    </div>
  </div>
  <!-- DataTables JavaScript -->
  <!-- Page-Level Demo Scripts - Tables - Use for reference -->
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