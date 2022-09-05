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
          <form name="frm" id="frm" action="pages/action-emp-salary" enctype="multipart/form-data" method="post" >
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
				<label>Select Employee:</label>
				<select name="es_employee" id="es_employee" class="form-control input-sm " required>
							<option value=""> Choose Department First</option>
							<!--Sub category goes here-->
							<?php 
									if (!empty(es_employee)) {
									$l_id = $row->es_employee;
									$sqlt1 = $db->query("select * from employee WHERE e_id = '$l_id'");
									while ($queryt1 = $sqlt1->fetch_object()) {
							?>
							<option <?php if($row->es_employee == $queryt1->e_id){ echo 'selected';} ?> value="
								<?= $queryt1->e_id; ?>">
								<?= $queryt1->e_name; ?>
							</option>
							<?php  } }?>
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
					$month_names = array("January","February","March","April","May","June","July","August","September","October","November","December");
					foreach($month_names as $key => $month)
					{
					?>
					<option <?php 
								if (!empty($_REQUEST['e_id'])) {if($row->es_month == $month){ echo 'selected';}} ?> value="<?php echo $key; ?>"><?php echo $month; ?></option>
					<?php 
					}
					?>
			</select>
            </div>
			</div>

			<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label>Present Days:</label>
              <input type="text" class="form-control input-sm" name="es_days" id="es_days"  value="<?php
              if (!empty($row->es_days)) {
                echo $row->es_days;
              }
              ?>" placeholder=" *" required readonly>
            </div>
            </div>
			
			<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label>Absent Days:</label>
              <input type="text" class="form-control input-sm" name="es_abdays" id="es_abdays"  value="<?php
              if (!empty($row->es_abdays)) {
                echo $row->es_abdays;
              }
              ?>" placeholder=" *" required readonly>
            </div>
            </div>
			<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label>Basic Salary:</label>
              <input type="text" class="form-control input-sm" name="es_bsalary" id="es_bsalary"  value="" placeholder=" *" required readonly>
            </div>
            </div>
			<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label>Gross Salary:</label>
              <input type="text" class="form-control input-sm" name="es_gsalary" id="es_gsalary"  value="" placeholder=" *" required readonly>
            </div>
            </div>
			<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label>Net Salary:</label>
              <input type="text" class="form-control input-sm" name="es_nsalary" id="es_nsalary"  value="" placeholder=" *" required readonly>
            </div>
            </div>
			<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label>Per Day Salary:</label>
              <input type="text" class="form-control input-sm" name="es_pdaysalary" id="es_pdaysalary" value="" placeholder=" *" required readonly>
            </div>
            </div>
			<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label>Leave Deduction:</label>
              <input type="text" class="form-control input-sm" name="es_ldeduction" id="es_ldeduction" value="" placeholder=" *" required readonly>
            </div>
            </div>
			<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <label>Payble Salary:</label>
              <input type="text" class="form-control input-sm" name="es_psalary" id="es_psalary" value="<?php
              if (!empty($row->es_psalary)) {
                echo $row->es_psalary;
              }
              ?>" placeholder=" *" required readonly>
            </div>
            </div>
		<div class="col-lg-4 col-md-4 col-xs-12">
            <div class="form-group">
              <?php if (!empty($_REQUEST['ea_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updateempsalary" />
                <input type="hidden" name="ea_id" value="<?= $row->ea_id; ?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="PAY	" class="btn btn-success">
                <input type="hidden" name="submit" value="addempsalary" />
              <?php } ?>
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
				</div>
			</div> -->
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
							$("#es_abdays").val(info['absent']); 
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
	</script>