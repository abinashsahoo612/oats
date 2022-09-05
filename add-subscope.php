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
		<title>Sub Scope</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Sub Scope </h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-3 col-md-3 col-xs-12">
          <?php
          if (empty($_REQUEST['sc_id'])) {
            $sc_id = '0';
          } else {
            $sc_id = $_REQUEST['sc_id'];
          }
          $results = $db->query("SELECT * FROM subscope WHERE sc_id = '$sc_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="pages/action-subscope.php" enctype="multipart/form-data" method="post" >
		   <div class="form-group">
				<label>Select Scope:</label>
				<select name="sc_scope" id="sc_scope" class="form-control input-sm " required>
					<option value="">Select Scope</option>
					<?php
						$sql = $db->query("select * from scope ");
						if (mysqli_num_rows($sql) > 0) {
							while ($query = $sql->fetch_object()) {
							?>
							<option <?php
								if (!empty($_REQUEST['sc_id'])) {
									if ($row->sc_scope === $query->s_id) {
										echo 'selected';
									}
								}
							?> value="<?php echo $query->s_id; ?>"><?php echo $query->s_name; ?></option>
							<?php
							}
						}
					?>
				</select>
			</div>
            <div class="form-group">
              <label>location Name:</label>
              <input type="text" class="form-control input-sm" name="sc_name" value="<?php
              if (!empty($row->sc_name)) {
                echo $row->sc_name;
              }
              ?>" placeholder="Sub Scope Name *" required>
            </div>
            <div class="form-group">
              <?php if (!empty($_REQUEST['sc_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updatesubscope" />
                <input type="hidden" name="sc_id" value="<?= $row->sc_id; ?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-success">
                <input type="hidden" name="submit" value="addsubscope" />
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
<!--										<th class="no-sort">Action</th>-->
										<th>Scope</th>
										<th>Sub Scope</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM `subscope`" );
									while ( $value = $data->fetch_object() ) {
										$sl++;
										?>
									<tr>
										<td>
											<?= $sl; ?>
										</td>
									
										<td>
											
										<?php
												$scope = $value->sc_scope; 
												$sqls = $db->query("select * from scope where s_id	 = '$scope' ");
												if (mysqli_num_rows($sql) > 0) {
												$querys = $sqls->fetch_object();
												echo $querys->s_name;
												}
										?>
										</td>	
										<td><?= $value->sc_name; ?></td>	
										<td>
													
													<a href="?sc_id=<?= $value->sc_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
													<a href="pages/action-subscope.php?sc_id=<?= $value->sc_id; ?>&submit=delete" class="btn btn-danger btn-xs" onClick="return confirm('Are You Sure want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
												
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
