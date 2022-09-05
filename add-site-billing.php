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
		<title>Site Billing</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Site Billing </h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-12 col-md-12 col-xs-12">
          <?php
          if (empty($_REQUEST['b_id'])) {
            $b_id = '0';
          } else {
            $b_id = $_REQUEST['b_id'];
          }
          $results = $db->query("SELECT * FROM billing WHERE b_id = '$b_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="pages/action-billing.php" enctype="multipart/form-data" method="post" >
		  
		<!-- <div class="col-lg-3 col-md-3 col-xs-12">
		  <div class="form-group">
				<label>Select Site </label>
				<select name="b_site" id="b_site" class="form-control input-sm" required>
					<option value="">Select Site</option>
					<?php
						// $sql = $db->query("select * from site ");
						// if (mysqli_num_rows($sql) > 0) {
						// 	while ($query = $sql->fetch_object()) {
						// 	?>
						// 	<option <?php
						// 		if (!empty($_REQUEST['b_id'])) {
						// 			if ($row->b_site === $query->s_id) {
						// 				echo 'selected';
						// 			}
						// 		}
							?> value="<?php //echo $query->s_id; ?>"><?php //echo $query->s_sitename; ?></option>
							<?php
						// 	}
						// }
					?>
					
				</select>
			</div>
			</div> -->
			
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Site ID:</label>
			  <input list="browsers" id="s_siteid" class="form-control input-sm" name="s_siteid" value="">
							<datalist id="browsers">
							<?php
									$sql = $db->query("SELECT * FROM site WHERE s_status='1'");
									if (mysqli_num_rows($sql) > 0) {
									while ($query = $sql->fetch_object()) {
							?>
								<option value="<?= $query->s_siteid; ?>">
								<?php 
											}
										}
								?> 

            </div>
            </div>
		<div class="col-lg-3 col-md-3 col-xs-12">
		  <div class="form-group">
				<label>Site Name</label>

				<input  type="text" class="form-control input-sm" id="sr_site" name="b_site" value="<?php if (!empty($row->sr_site)) {
					echo $row->sr_site;
				}
				?>" placeholder="Site Name" readonly>
				</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Bill No:</label>
              <input type="text" class="form-control input-sm" name="b_billno" id="b_billno" value="<?php
              if (!empty($row->b_billno)) {
                echo $row->b_billno;
              }
              ?>" placeholder="Bill No*"  required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Bill Name:</label>
              <input type="text" class="form-control input-sm" name="b_billname" id="b_billname" value="<?php
              if (!empty($row->b_billname)) {
                echo $row->b_billname;
              }
              ?>" placeholder="Bill Name *"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Bill Amount:</label>
              <input type="text" class="form-control input-sm" name="b_billamount" id="b_billamount" value="<?php
              if (!empty($row->b_billamount)) {
                echo $row->b_billamount;
              }
              ?>" placeholder="Bill amount*"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Retention deductionamt:</label>
              <input type="text" class="form-control input-sm" name="b_rdeductamount" id="b_rdeductamount" value="<?php
              if (!empty($row->b_rdeductamount)) {
                echo $row->b_rdeductamount;
              }
              ?>" placeholder="Retention deductionamt*"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>TDS deduction amt:</label>
              <input type="text" class="form-control input-sm" name="b_tdeductamount" id="b_tdeductamount" value="<?php
              if (!empty($row->b_tdeductamount)) {
                echo $row->b_tdeductamount;
              }
              ?>" placeholder="TDS deduction amount*"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Payment Recieved amount:</label>
              <input type="text" class="form-control input-sm" name="b_pramount" id="b_pramount" value="<?php
              if (!empty($row->b_pramount)) {
                echo $row->b_pramount;
              }
              ?>" placeholder="Payment Recieved amount *"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Payment Recieved status:</label>
              <input type="text" class="form-control input-sm" name="b_pstatus" id="sr_mparticulars" value="<?php
              if (!empty($row->b_pstatus)) {
                echo $row->b_pstatus;
              }
              ?>" placeholder="Payment Recieved status *"  >
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Payment Recieved Date:</label>
              <input type="date" class="form-control input-sm" name="b_prdate" id="se_pamount" value="<?php
              if (!empty($row->b_prdate)) {
                echo $row->b_prdate;
              }
              ?>" placeholder="YY-MM-DD *"  >
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Remark:</label>
              <input type="text" class="form-control input-sm" name="b_remark" value="<?php
              if (!empty($row->b_remark)) {
                echo $row->b_remark;
              }
              ?>" placeholder="Remark *" >
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <?php if (!empty($_REQUEST['b_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updatebilling" />
                <input type="hidden" name="b_id" value="<?= $row->b_id; ?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-success">
                <input type="hidden" name="submit" value="addbilling" />
              <?php } ?>
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
										<th>Site</th>
										<th>Bill No</th>
										<th>Bill Date</th>
										<th>Bill Name</th>
										<th>Bill Amount</th>
										<th>Retention deductionamt</th>
										<th>TDS deduction amt</th>
										<th>Payment recieved Date</th>
										<th>Payment recieved Amount</th>
										<th>Payment ecieved Status</th>
										<th>Remarks</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM `billing`" );
									while ( $value = $data->fetch_object() ) {
										$sl++;
										?>
									<tr>
										<td>
											<?= $sl; ?>
										</td>
										<td><?php
												echo $s_id = $value->b_site;
												// $sqlc = $db->query("select * from site WHERE s_id = '$s_id'");
												// if((mysqli_num_rows($sqlc)) > 0) {
												// $queryc = $sqlc->fetch_object();
												// echo $queryc->s_sitename;
												// }
										?></td>	
									
										<td><?= $value->b_billno; ?></td>	
										<td><?= $value->b_cdate; ?></td>	
										<td><?= $value->b_billname; ?></td>	
										<td><?= $value->b_billamount; ?></td>
										<td><?= $value->b_rdeductamount; ?></td>
										<td><?= $value->b_tdeductamount; ?></td>	
										<td><?= $value->b_prdate; ?></td>	
										<td><?= $value->b_pramount; ?></td>
										<td><?= $value->b_pstatus; ?></td>
										<td><?= $value->b_remark; ?></td>
										<td>
												<a href="?b_id=<?= $value->b_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
												<a href="pages/action-billing.php?b_id=<?= $value->b_id; ?>&submit=delete" class="btn btn-danger btn-xs" onClick="return confirm('Are You Sure want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
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



		$('#b_rdeductamount').keyup(function () {
			calculate();
        });
		$('#b_tdeductamount').keyup(function () {
			calculate();
        });
		     
	function calculate(){
		
	billamt = $('#b_billamount').val();
	rdeduct	= $('#b_rdeductamount').val();
		if(rdeduct == ''){
			$('#b_rdeductamount').val(0);	
		}
	tdeduct	= $('#b_tdeductamount').val();
		if(tdeduct == ''){
			$('#b_tdeductamount').val(0);	
		}

		rcvamt = billamt - rdeduct - tdeduct;

	$('#b_pramount').val(rcvamt.toFixed(2));	
	}

		

		
		$( '#s_siteid' ).keyup(function () {
			var siteID = $( this ).val();
			if ( siteID ) {
				$.ajax( {
					type: 'POST',
					url: 'ajax_site.php',
					data: 'pid=' + siteID,
					dataType: "json",
					success: function ( html ) {//alert(html['subscope']);
						$( '#sr_site' ).val( html['site'] );
					}
				} );
			} 
		} );

		$( '#se_site' ).on( 'change', function () {
			var siteID = $( this ).val();
			if ( siteID ) {
				$.ajax( {
					type: 'POST',
					url: 'ajax_sitedetails.php',
					data: 'pid=' + siteID,
					dataType: "json",
					success: function (info) {//alert(info);
						$('#se_employee').val(info['ename']);
						$('#se_paidamount').val(info['paidamount']);
						
					}
				});
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
<!-- 
<script>
	/*Auto Complete*/
	$(function() {
		var availableNames = <?php//$mnamesJSN?>;
		$('#s_siteid').autocomplete({
			source: availableNames
		});
	});
</script> -->