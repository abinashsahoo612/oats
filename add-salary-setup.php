<?php
	session_start();
	require_once 'config/config.php';
	require_once 'config/helper.php';
	$e_id = $_REQUEST['e_id'];
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
		<title>Accounts</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
          <?php
          if (empty($_REQUEST['e_id'])) {
            $e_id = '0';
          } else {
            $e_id = $_REQUEST['e_id'];
          }
          $results = $db->query("SELECT * FROM employee WHERE e_id = '$e_id'");
          $row = $results->fetch_object();
		  $jobcat = $row->e_jobcat;
		  $emp =  $row->e_name;

		$ds_id = $row->e_designation;
		$sqlds = $db->query("select * from designation WHERE ds_id = '$ds_id'");
		if((mysqli_num_rows($sqlds)) > 0) {
		$queryds = $sqlds->fetch_object();
		$desig = $queryds->ds_name;
		}

          $resulte = $db->query("SELECT * FROM salryamount");
          while($rowe = $resulte->fetch_object()){
		  if(($rowe->se_type ==  'EPF')){
		  $epf =  $rowe->se_percentage;
		  }
		  if(($rowe->se_type ==  'ESIC')){
		  $esic =  $rowe->se_percentage;
		  }

		}
		?>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">Accounts Setup </h2>
					<h4 class="page-header"><strong>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> &nbsp;&nbsp;<?= $emp; ?><br>
					<strong>Designation :</strong>&nbsp;&nbsp; <?= $desig; ?></h4>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-12 col-md-12 col-xs-12">
          <form name="frm" id="frm" action="pages/action-salary-setup.php" enctype="multipart/form-data" method="post" >
			
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Basic Salary:</label>
				<input type="text" class="form-control input-sm" name="e_bsalary" id="e_bsalary" value="<?php
				if (!empty($row->e_bsalary)) {
					echo $row->e_bsalary;
				}
				?>" placeholder="Basic Salary *" required>
				
				<input type="hidden" name="e_jobtype" id="e_jobtype" value="<?= $jobcat; ?>" />
            </div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-xs-12">
			
            <div class="form-group">
              <label>DA:</label>
              <input type="text" class="form-control input-sm" name="e_da" id="e_da" value="<?php
              if (!empty($row->e_da)) {
                echo $row->e_da;
              }
              ?>" placeholder="DA *" required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			
            <div class="form-group">
              <label>HRA</label>
              <input type="text" class="form-control input-sm" name="e_hra" id="e_hra" value="<?php
              if (!empty($row->e_hra)) {
                echo $row->e_hra;
              }
              ?>" placeholder="HRA*"  required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
              <label>Other Allowance:</label>
              <input type="text" class="form-control input-sm" name="e_allowance" id="e_allowance" value="<?php
              if (!empty($row->e_allowance)) {
                echo $row->e_allowance;
              }
              ?>" placeholder="Other Allowance *" required>
            </div>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Other Special Allowance:</label>
              <input type="text" class="form-control input-sm" name="e_sallowance" id="e_sallowance"  value="<?php
              if (!empty($row->e_sallowance)) {
                echo $row->e_sallowance;
              }
              ?>" placeholder="Other Special Allowance *" required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			
            <div class="form-group">
              <label>Gross Salary:</label>
              <input type="text" class="form-control input-sm" name="e_gsalary" id="e_gsalary" value="<?php
              if (!empty($row->e_gsalary)) {
                echo $row->e_gsalary;
              }
              ?>" placeholder="Gross Salary *" required readonly>
            </div>
            </div>
			<?php if($jobcat == 'P'){ ?>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>EPF Applicable</label>
				<select name="epfpermission" id="epfpermission" class="form-control input-sm" required>
					<option value="Yes">Yes</option>
					<option value="No">No</option>
					
				</select>
			</div>
			</div>
			<?php } else { ?>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>EPF Applicable</label>
				<select name="epfpermission" id="epfpermission" class="form-control input-sm" disabled>
					<option value="Yes">Yes</option>
					<option value="No">No</option>
					
				</select>
			</div>
			</div>
			<?php } ?>
				

			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>EPF:</label>
              <input type="text" class="form-control input-sm" name="e_epfamount" id="e_epfamount" value="<?php
              if (!empty($row->e_epfamount)) {
                echo $row->e_epfamount;
              }
              ?>" placeholder="EPF Amount *" required readonly>
			  <input type="hidden" name="e_epfper" id="e_epfper" value="<?= $epf; ?>" />
            </div>
            </div>
			<?php if($jobcat == 'P'){ ?>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>ESIC Applicable</label>
				<select name="esicpermission" id="esicpermission" class="form-control input-sm" required>
					<option value="Yes">Yes</option>
					<option value="No">No</option>
					
				</select>
			</div>
			</div>
			<?php } else { ?>
				
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>ESIC Applicable</label>
				<select name="esicpermission" id="esicpermission" class="form-control input-sm"  disabled>
					<option value="Yes">Yes</option>
					<option value="No">No</option>
					
				</select>
			</div>
			</div>
			<?php } ?>
			<div class="col-lg-3 col-md-3 col-xs-12">
			 <div class="form-group">
              <label>ESIC :</label>
              <input type="text" class="form-control input-sm" name="e_esicamount" id="e_esicamount" value="<?php
              if (!empty($row->e_esicamount)) {
                echo $row->e_esicamount;
              }
              ?>" placeholder="ESIC Amount *" required readonly>
			  <input type="hidden" name="e_esicper" id="e_esicper" value="<?= $esic; ?>" />
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
              <label>IT:</label>
              <input type="text" class="form-control input-sm" name="e_it" id="e_it" value="<?php
              if (!empty($row->e_it)) {
                echo $row->e_it;
              }
              ?>" placeholder="IT *" required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Proffessional Tax:</label>
              <input type="text" class="form-control input-sm" name="e_ptax" id="e_ptax" value="<?php
              if (!empty($row->e_ptax)) {
                echo $row->e_ptax;
              }
              ?>" placeholder="Proffessional Tax*" required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Other:</label>
              <input type="text" class="form-control input-sm" name="e_other" id="e_other" value="<?php
              if (!empty($row->e_other)) {
                echo $row->e_other;
              }
              ?>" placeholder="Other *" required>
            </div>
            </div>
			
			<div class="col-lg-3 col-md-3 col-xs-12">
          <div class="form-group">
              <label>Total Deduction:</label>
              <input type="text" class="form-control input-sm" name="e_tdeduction" id="e_tdeduction" value="<?php
              if (!empty($row->e_tdeduction)) {
                echo $row->e_tdeduction;
              }
              ?>" placeholder="Total Deduction *" required readonly>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
          <div class="form-group">
              <label>Net Salary:</label>
              <input type="text" class="form-control input-sm" name="e_nsalary" id="e_nsalary" value="<?php
              if (!empty($row->e_nsalary)) {
                echo $row->e_nsalary;
              }
              ?>" placeholder="Net Salary *" required readonly>
            </div>
            </div>
			<!-- <div class="col-lg-3 col-md-3 col-xs-12">
          <div class="form-group">
              <label>Per Day Salary:</label>
              <input type="text" class="form-control input-sm" name="e_pdaysalary" id="e_pdaysalary" value="<?php
              if (!empty($row->e_pdaysalary)) {
                echo $row->e_pdaysalary;
              }
              ?>" placeholder="Net Salary *" required readonly>
            </div>
            </div> -->
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updatesalarysetup" />
                <input type="hidden" name="e_id" value="<?= $row->e_id; ?>" />
            </div>
            </div>
          </form>
        </div>
		
		<div class="col-lg-12 col-md-12 col-xs-12">
			
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="dataTable_wrapper">
							<table width="100%" class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
								<thead>
									<tr>
										<th class="no-sort">Sl.</th>
<!--									<th class="no-sort">Action</th>-->
										<th>Basic Salary</th>
										<th>DA</th>
										<th>HRA</th>
										<th>Other Allowance</th>
										<th>Other Special Allowance</th>
										<th>Gross Salary</th>
										<th>EPF Amount</th>
										<th>Esic Amount</th>
										<th>IT</th>
										<th>Proffessional tax</th>
										<th>Other </th>
										<th>Net Salary</th>
										<!-- <th>Per Day Salary</th> -->
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM `employee` where e_id = '$e_id'" );
									while ( $value = $data->fetch_object() ) {
										$sl++;

										?>
									<tr>
										<td><?= $sl; ?></td>
										<td><?= $value->e_bsalary; ?></td>	
										<td><?= $value->e_da; ?></td>	
										<td><?= $value->e_hra; ?></td>	
										<td><?= $value->e_allowance; ?></td>
										<td><?= $value->e_sallowance; ?></td>	
										<td><?= $value->e_gsalary; ?></td>	
										<td><?= $value->e_epfamount; ?></td>	
										<td><?= $value->e_esicamount; ?></td>	
										<td><?= $value->e_it; ?></td>	
										<td><?= $value->e_ptax; ?></td>	
										<td><?= $value->e_other; ?></td>	
										<td><?= $value->e_nsalary ?></td>	
										<!-- <td><?php // $value->e_pdaysalary ?></td>	 -->
									<td>
													
												<a href="?e_id=<?= $value->e_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
												
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
<script type="text/javascript">
	$( document ).ready( function () {
		$('#e_bsalary').keyup(function () {
			calculate();
        });
		$('#e_allowance').keyup(function () {
			calculate();
        });
		$('#e_sallowance').keyup(function () {
			calculate();
        });
		$('#e_da').keyup(function () {
			calculate();
        });
		$('#e_hra').keyup(function () {
			calculate();
        });
		$('#e_gsalary').keyup(function () {
			calculate();
        });
		
		$('#e_epfamount').keyup(function () {
			calculate();
        });
		$('#e_esicamount').keyup(function () {
			calculate();
        });
		$('#e_it').keyup(function () {
			calculate();
        });
		$('#e_ptax').keyup(function () {
			calculate();
        });
		$('#e_other').keyup(function () {
			calculate();
        });
        

		
		//function epffunction(){ alert('ggg');
		$('#epfpermission').on('change', function () { //alert('ggg');
			var permission = $(this).val();

		bsalary = $('#e_bsalary').val().replace(/,/g, '.');
		epfp = $('#e_epfper').val();
		jobtype = $('#e_jobtype').val();

		// epf = 12;
		// esic = 0.75;
		epf_amount  = 	(epfp/100)* bsalary;
		if(jobtype =='P'){

			if(permission == 'Yes'){

			$('#e_epfamount').val(epf_amount.toFixed(2));
		
		}else{
			
			$('#e_epfamount').val(0);
		}
		
		}else{
			$('#e_epfamount').val(0);
		}
		


		});

	// 	function esicfunction(){
		$('#esicpermission').on('change', function () {
			var permission = $(this).val();
			if(permission == 'Yes'){

		bsalary = $('#e_bsalary').val().replace(/,/g, '.');
		esicp = $('#e_esicper').val();
		jobtype = $('#e_jobtype').val();

		// epf = 12;
		// esic = 0.75;
		esic_amount  = 	(esicp/100)* bsalary;
		
		if(jobtype =='P'){
		$('#e_esicamount').val(esic_amount.toFixed(2));		
		}else{
			
		$('#e_esicamount').val(0);		
		}
		}else{
			
			$('#e_esicamount').val(0);
		}

		});

	function calculate(){
        
		 bsalary = $('#e_bsalary').val().replace(/,/g, '.');
		// epfp = $('#e_epfper').val();
		// esicp = $('#e_esicper').val();
		// jobtype = $('#e_jobtype').val();

		// // epf = 12;
		// // esic = 0.75;
		// epf_amount  = 	(epfp/100)* bsalary;
		// esic_amount  = 	(esicp/100)* bsalary;
		// if(jobtype =='P'){
		// $('#e_epfamount').val(epf_amount.toFixed(2));
		// }else{
		// $('#e_epfamount').val(0);
		// }
		
		// if(jobtype =='P'){
		// $('#e_esicamount').val(esic_amount.toFixed(2));		
		// }else{
			
		// $('#e_esicamount').val(0);		
		// }


		da = $('#e_da').val().replace(/,/g, '.');
		if(da == '')	{
			$('#e_da').val(0);			
		}
		hra = $('#e_hra').val().replace(/,/g, '.');
		if(hra == '')	{
			$('#e_hra').val(0);			
		}
		allowance = $('#e_allowance').val().replace(/,/g, '.');
		if(allowance == '')	{
			$('#e_allowance').val(0);			
		}
		sallowance = $('#e_sallowance').val().replace(/,/g, '.');
		if(sallowance == '')	{
			$('#e_sallowance').val(0);			
		}
		gsalary = $('#e_gsalary').val().replace(/,/g, '.');
		if(gsalary == '')	{
			$('#e_gsalary').val(0);			
		}

		
        gsalary=parseFloat(bsalary)+parseFloat(da)+parseFloat(hra)+parseFloat(allowance)+parseFloat(sallowance);
		$('#e_gsalary').val(gsalary.toFixed(2));

		
		epf = $('#e_epfamount').val().replace(/,/g, '.');
		if(epf == '')	{
			$('#e_epfamount').val(0);			
		}
		esic = $('#e_esicamount').val().replace(/,/g, '.');
		if(esic == '')	{
			$('#e_esicamount').val(0);			
		}
		it = $('#e_it').val().replace(/,/g, '.');
		if(it == '')	{
			$('#e_it').val(0);			
		}
		tax = $('#e_ptax').val().replace(/,/g, '.');
		if(tax == '')	{
			$('#e_ptax').val(0);			
		}
		other = $('#e_other').val().replace(/,/g, '.');
		if(other == '')	{
			$('#e_other').val(0);			
		}
		tdeducion = parseFloat(epf)+parseFloat(esic)+parseFloat(it)+parseFloat(tax)+parseFloat(other);
		$('#e_tdeduction').val(tdeducion.toFixed(2));
        nsalary=parseFloat(gsalary)-parseFloat(epf)-parseFloat(esic)-parseFloat(it)-parseFloat(tax)-parseFloat(other);
		$('#e_nsalary').val(nsalary.toFixed(2));

		pdaysalary = gsalary/30;
		$('#e_pdaysalary').val(pdaysalary.toFixed(2));
    }

		$( '#e_circle' ).on( 'change', function () {
			var productID = $( this ).val();
			if ( productID ) {
				$.ajax( {
					type: 'POST',
					url: 'ajax_location.php',
					data: 'pid=' + productID,
					success: function ( html ) {
						$( '#e_location' ).html( html );
					}
				} );
			} else {
				$( '#e_location' ).html( '<option value="">Choose Circle First</option>' );
			}
		} );


  
  $("#e_contact").on("blur", function(){
        var mobNum = $(this).val();
        var filter = /^\d*(?:\.\d{1,2})?$/;

          if (filter.test(mobNum)) {
            if(mobNum.length==10){
                  alert("valid");
             } else {
                alert('Please put 10  digit mobile number');
                return false;
              }
            }
            else {
              alert('Not a valid number');
              return false;
           }
    
  });
  
});
	
</script>
