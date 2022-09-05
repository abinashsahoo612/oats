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
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Manage Leave</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Manage Leave </h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-3 col-md-3 col-xs-12">
          <?php
          if (empty($_REQUEST['r_id'])) {
            $r_id = '0';
          } else {
            $r_id = $_REQUEST['r_id'];
          }
          $results = $db->query("SELECT * FROM reason WHERE r_id = '$r_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="pages/action-abreason.php" enctype="multipart/form-data" method="post" >	
			  <div class="form-group">
				<label>Select Leave type</label>
				<select name="r_type" id="r_type" class="form-control input-sm" required>
				
				<option value="">Select Holiday type</option>
				<option <?php
					if (!empty($_REQUEST['r_id'])) {
						if ($row->r_type === 'CL') {
							echo 'selected';
						}
					}
				?> value="CL">CL</option>
				<option <?php
					if (!empty($_REQUEST['h_id'])) {
						if ($row->r_type === 'EL') {
							echo 'selected';
						}
					}
				?> value="EL">EL</option>
				<option <?php
					if (!empty($_REQUEST['h_id'])) {
						if ($row->r_type === 'SPL') {
							echo 'selected';
						}
					}
				?> value="SPL">SPL</option>
				</select>
			</div>
            <div class="form-group">
              <label>No.Of Days Per Year:</label>
              <input type="text" class="form-control input-sm" name="r_days" value="<?php
              if (!empty($row->r_days)) {
                echo $row->r_days;
              }
              ?>" placeholder="No Of Days *" required>
            </div>
            <div class="form-group">
              <?php if (!empty($_REQUEST['r_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updatereason" />
                <input type="hidden" name="r_id" value="<?= $row->r_id; ?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-success">
                <input type="hidden" name="submit" value="addreason" />
              <?php } ?>
            </div>
          </form>
        </div>
		
		<div class="col-lg-9 col-md-9 col-xs-12">
			
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="dataTable_wrapper">
							<table width="100%" class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
								<thead>
									<tr>
										<th class="no-sort">Sl.</th>
										<!--<th class="no-sort">Action</th>-->
										<th>Leave Type</th>
										<th>NO Of Days Per Year</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM `reason`" );
									while ( $value = $data->fetch_object() ) {
										$sl++;
										?>
									<tr>
										<td>
											<?= $sl; ?>
										</td>
										<td><?= $value->r_type; ?></td>	
										<td><?= $value->r_days; ?></td>	
										<td>	
													<a href="?r_id=<?= $value->r_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
													<a href="pages/action-abreason.php?r_id=<?= $value->r_id; ?>&submit=delete" class="btn btn-danger btn-xs" onClick="return confirm('Are You Sure want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
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
	</div>
</div>
<!-- /#page-wrapper -->
<?php include_once 'footer.php'; ?>
