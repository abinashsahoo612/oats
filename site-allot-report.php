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

$FromDate = $ToDate = date('Y-m-d');$circle='';$xtra='';
if ($_POST && $_POST['submit'] == 'saleReport') {
   $circle = mysqli_real_escape_string($db, $_REQUEST['circle']);
   $FromDate = mysqli_real_escape_string($db, $_REQUEST['FromDate']);
  $ToDate = mysqli_real_escape_string($db, $_REQUEST['ToDate']);
  //$TaxType = mysqli_real_escape_string($db, $_REQUEST['TaxType']);

  if(!empty($circle)){
	$xtra=" AND s_circle='$circle'";
  }else {
	$xtra ='';
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
    <title> Site Allotment Report</title>
    <?php include_once 'header.php'; ?>
    <style>
      .no-sort::after { display: none!important;}
      th,td { text-align:center;}
    </style>
  <div id="page-wrapper">
    <?php include_once 'msg.php'; ?>
    <div class="row">
      <div class="col-lg-12">
        <h2 class="page-header text-info">Site Allotment Reports</h2>
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
                        <label for="FromDate">Select Circle:</label>
                        <select name="circle" id="circle" class="form-control input-sm">
							<option value="">Select Circle</option>
							<?php
							$sql = $db->query("SELECT * FROM `circle` WHERE c_status='1'");
							if (mysqli_num_rows($sql) > 0) {
							  while ($query = $sql->fetch_object()) {
								?>
								<option value="<?php echo $query->c_id; ?>"><?php echo $query->c_name; ?></option>
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
				Circle :&nbsp;<?= $circle ?><?php } ?><br>
		</div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
				<tr>
					<th class="no-sort">Sl.</th>
										<th>Date</th>
										<th>Circle</th>
										<th>Site Allotted To</th>
										<th>Site Id</th>
										<th>Site Name</th>
										<th>Address</th>
										<th>Department</th>
										<th>Cluster</th>
										<th>Scope</th>
										<th>Work Order no</th>
										<th>Client Unit price</th>
										<th>Vendor Unit price</th>
                </tr>
              </thead>
              <tbody>
                <?php
					$sl =0;
					$data = $db->query( "SELECT * FROM `site` where  DATE(s_date) >= DATE('$FromDate') AND DATE(s_date) <= DATE('$ToDate') $xtra " );
					while ( $value = $data->fetch_object() ) {
					$sl++;
                  ?>
					<tr>
                        <td><?= $sl; ?></td>
										<td><?= $value->s_date; ?></td>
                        <td>
						<?php
						if (!empty($value->s_circle)) {
							$circle = $value->s_circle;
							$sqlcat = $db->query("SELECT * FROM `circle` WHERE c_id = '$circle'");
							$pnm = $sqlcat->fetch_object();
							echo $pnm->c_name;
						}
						?>
						</td>
										<td><?= $value->s_allotto; ?></td>
										<td><?= $value->s_siteid; ?></td>	
										<td><?= $value->s_sitename; ?></td>	
										<td><?= $value->s_addrs; ?></td>
										<td><?php
												$d_id = $value->s_department;
												$sqld = $db->query("select * from department WHERE d_id = '$d_id'");
												if((mysqli_num_rows($sqld)) > 0) {
												$queryd = $sqld->fetch_object();
												echo $queryd->d_name;
												}
										?></td>	
										<td><?php
												$c_id = $value->s_cluster;
												$sqld = $db->query("select * from cluster WHERE c_id = '$c_id'");
												if((mysqli_num_rows($sqld)) > 0) {
												$queryd = $sqld->fetch_object();
												echo $queryd->c_name;
												}
										?></td>	
										<td><?php
										$scope = $value->s_scope;
										foreach ( explode( ',', $scope ) as $perm ) { 
											$s_id = $perm;
												$sqld = $db->query("select * from scope WHERE s_id = '$s_id'");
												if((mysqli_num_rows($sqld)) > 0) {
												$queryd = $sqld->fetch_object();
												$scope = $queryd->s_name;
												echo $scope.','; 
												}
											
											}	?></td>	
										<td><?= $value->s_workno; ?></td>	
										<td><?= $value->s_cunitprice; ?></td>
										<td><?= $value->s_vunitprice; ?></td>

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