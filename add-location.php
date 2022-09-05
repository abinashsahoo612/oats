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
		<title>Location</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Add Location </h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-3 col-md-3 col-xs-12">
          <?php
          if (empty($_REQUEST['l_id'])) {
            $l_id = '0';
          } else {
            $l_id = $_REQUEST['l_id'];
          }
          $results = $db->query("SELECT * FROM location WHERE l_id = '$l_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="pages/action-location.php" enctype="multipart/form-data" method="post" >
		   <div class="form-group">
				<label>Select Circle:</label>
				<select name="l_circle" id="l_circle" class="form-control input-sm " required>
					<option value="">Select Circle</option>
					<?php
						$sql = $db->query("select * from circle ");
						if (mysqli_num_rows($sql) > 0) {
							while ($query = $sql->fetch_object()) {
							?>
							<option <?php
								if (!empty($_REQUEST['l_id'])) {
									if ($row->l_circle === $query->c_id) {
										echo 'selected';
									}
								}
							?> value="<?php echo $query->c_id; ?>"><?php echo $query->c_name; ?></option>
							<?php
							}
						}
					?>
				</select>
			</div>
            <div class="form-group">
              <label>location Name:</label>
              <input type="text" class="form-control input-sm" name="l_name" value="<?php
              if (!empty($row->l_name)) {
                echo $row->l_name;
              }
              ?>" placeholder="location Name *" required>
            </div>
            <div class="form-group">
              <?php if (!empty($_REQUEST['l_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updatelocation" />
                <input type="hidden" name="l_id" value="<?= $row->l_id; ?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-success">
                <input type="hidden" name="submit" value="addlocation" />
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
										<th>Circle</th>
										<th>Location</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM `location`" );
									while ( $value = $data->fetch_object() ) {
										$sl++;
										?>
									<tr>
										<td>
											<?= $sl; ?>
										</td>
									
										<td>
											
										<?php
												$circle = $value->l_circle; 
												$sqls = $db->query("select * from circle where c_id = '$circle' ");
												if (mysqli_num_rows($sql) > 0) {
												$querys = $sqls->fetch_object();
												echo $querys->c_name;
												}
										?>
										</td>	
										<td><?= $value->l_name; ?></td>	
										<td>	
											<a href="?l_id=<?= $value->l_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
											<a href="pages/action-location.php?l_id=<?= $value->l_id; ?>&submit=delete" class="btn btn-danger btn-xs" onClick="return confirm('Are You Sure want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
												
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
