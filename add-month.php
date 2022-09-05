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
		<title>Month setup</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Month setup </h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-3 col-md-3 col-xs-12">
          <?php
          if (empty($_REQUEST['m_id'])) {
            $m_id = '0';
          } else {
            $m_id = $_REQUEST['m_id'];
          }
          $results = $db->query("SELECT * FROM month WHERE m_id = '$m_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="pages/action-month.php" enctype="multipart/form-data" method="post" >
			  
		 
		  <div class="form-group">
		  		<label for=""> Year:</label>  
					<?php
						$currently_selected = date('Y'); 
						$earliest_year = 1950; 
						$latest_year = date('Y'); 

						print '<select name="year" id="year" class="form-control input-sm">';
						foreach ( range( $latest_year, $earliest_year ) as $i ) {
							print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
						}
						print '</select>';
					?>
		  </div>
		   <div class="form-group">
				<label>Select Month:</label> 
				<select name="m_month" id="m_month" class="form-control input-sm">
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
            <div class="form-group">
              <label>No Of Days:</label>
              <input type="text" class="form-control input-sm" name="m_days" value="<?php
              if (!empty($row->m_days)) {
                echo $row->m_days;
              }
              ?>" placeholder="No Of Days *" required>
            </div>
            <div class="form-group">
              <?php if (!empty($_REQUEST['m_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updatemonth" />
                <input type="hidden" name="m_id" value="<?= $row->m_id; ?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-success">
                <input type="hidden" name="submit" value="addmonth" />
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
										<th>Year</th>
										<th>Month</th>
										<th>No Of Days</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM `month`" );
									while ( $value = $data->fetch_object() ) {
									$sl++;
									?>
									<tr>
										<td><?= $sl; ?></td>
										<td><?= $value->m_year; ?></td>
										<td><?php if(($value->m_month) == 1){ echo 'January';}
													if(($value->m_month) == 2){ echo 'February';}
													if(($value->m_month) == 3){ echo 'march';}
													if(($value->m_month) == 4){ echo 'April';}
													if(($value->m_month) == 5){ echo 'May';}
													if(($value->m_month) == 6){ echo 'June';}
													if(($value->m_month) == 7){ echo 'July';}
													if(($value->m_month) == 8){ echo 'August';}
													if(($value->m_month) == 9){ echo 'September';}
													if(($value->m_month) ==10){ echo 'October';}
													if(($value->m_month) == 11){ echo 'November';}
													if(($value->m_month) == 12){ echo 'December';} ?></td>
										<!-- <td><?=	$value->m_month; ?></td>	 -->
										<td><?= $value->m_days; ?></td>	
										<td>		
											<a href="?m_id=<?= $value->m_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
											<a href="pages/action-month.php?m_id=<?= $value->m_id; ?>&submit=delete" class="btn btn-danger btn-xs" onClick="return confirm('Are You Sure want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
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
