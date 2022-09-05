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
		<title>Site Expense</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Site Expense </h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-12 col-md-12 col-xs-12">
          <?php
          if (empty($_REQUEST['se_id'])) {
            $s_id = '0';
          } else {
            $s_id = $_REQUEST['se_id'];
          }
          $results = $db->query("SELECT * FROM expense WHERE se_id = '$s_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="pages/action-expense.php" enctype="multipart/form-data" method="post" >
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
					<input  type="text" class="form-control input-sm" id="se_site" name="se_site" value="<?php if (!empty($row->se_site)) {
						echo $row->se_site;
					}
					?>" placeholder="Site Name" readonly>
				</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
					<label>Scope</label>

					<input  type="text" class="form-control input-sm" id="sr_scope" name="sr_scope" value="<?php if (!empty($row->sr_scope)) {
						echo $row->sr_scope;
					}
					?>" placeholder="Scope" readonly>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
					<label>Sub Scope</label>
					<input  type="text" class="form-control input-sm" id="sr_sscope" name="sr_sscope" value="<?php if (!empty($row->sr_sscope)) {
						echo $row->sr_sscope;
					}
					?>" placeholder="Sub Scope" readonly>
				</div>
			</div>
		
		<!-- <div class="col-lg-3 col-md-3 col-xs-12">
		  <div class="form-group">
				<label>Select Site </label>
				<select name="se_site" id="se_site" class="form-control input-sm" required>
					<option value="">Select Site</option>
					<?php
						$sql = $db->query("select * from site ");
						if (mysqli_num_rows($sql) > 0) {
							while ($query = $sql->fetch_object()) {
							?>
							<option <?php
								if (!empty($_REQUEST['se_id'])) {
									if ($row->se_site === $query->s_id) {
										echo 'selected';
									}
								}
							?> value="<?php echo $query->s_id; ?>"><?php echo $query->s_sitename; ?></option>
							<?php
							}
						}
					?>
					
				</select> 
			</div>
			</div>-->
			<!-- <div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Site ID:</label>
			  <input  type="text" class="form-control input-sm" name="s_siteid" value="<?php
						echo '-'. sprintf("%03d",0 );
				if (!empty($row->s_siteid)) {
					echo $row->s_siteid;
				}
				?>" placeholder="Auto Generate ">
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Site Name</label>
              <input type="text" class="form-control input-sm" name="s_name" id="s_name" value="<?php
              if (!empty($row->s_name)) {
                echo $row->s_name;
              }
              ?>" placeholder="Contact no *"  required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			
            <div class="form-group">
              <label>Address:</label>
              <input type="text" class="form-control input-sm" name="s_addrs" id="s_addrs" value="<?php
              if (!empty($row->s_addrs)) {
                echo $row->s_addrs;
              }
              ?>" placeholder="Address *"  required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Work Order No:</label>
              <input type="text" class="form-control input-sm" name="s_wono" id="s_wono" value="<?php
              if (!empty($row->s_wono)) {
                echo $row->s_wono;
              }
              ?>" placeholder="Work Order No *"  required>
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Client Unit price:</label>
              <input type="text" class="form-control input-sm" name="s_cunitprice" id="s_cunitprice" value="<?php
              if (!empty($row->s_cunitprice)) {
                echo $row->s_cunitprice;
              }
              ?>" placeholder="Client Unt price *"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			 <div class="form-group">
              <label>Vendor Unit price:</label>
              <input type="text" class="form-control input-sm" name="s_vunitprice" value="<?php
              if (!empty($row->s_vunitprice)) {
                echo $row->s_vunitprice;
              }
              ?>" placeholder="Vendor unit price *" required>
            </div>
            </div>
			 
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Select Employee</label>
				<select name="sr_employee" id="sr_employee" class="form-control input-sm" required>
					<option value="">Select Department</option>
					<?php
						$sqld = $db->query("select * from employee ");
						if (mysqli_num_rows($sqld) > 0) {
							while ($queryd = $sqld->fetch_object()) {
							?>
							<option <?php
								if (!empty($_REQUEST['sr_id'])) {
									if ($row->sr_employee === $queryd->e_id) {
										echo 'selected';
									}
								}
							?> value="<?php echo $queryd->e_id; ?>"><?php echo $queryd->e_name; ?></option>
							<?php
							}
						}
					?>
				</select>
			</div>
			</div>-->
			
			<!-- <div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Employee:</label>
              <input type="text" class="form-control input-sm" name="se_employee" id="se_employee" value="<?php
            //   if (!empty($row->se_employee)) {
            //     echo $row->se_employee;
            //   }
              ?>" placeholder="Employee*"  required>
			  
            </div>
            </div> -->

			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Select Department </label>
				<select name="se_department" id="sr_department" class="form-control input-sm" required>
					<option value="">Select Department</option>
					<?php
						$sql = $db->query("select * from department ");
						if (mysqli_num_rows($sql) > 0) {
							while ($query = $sql->fetch_object()) {
							?>
							
							<option <?php
								if (!empty($_REQUEST['e_id'])) {
									if ($row->sr_department === $query->d_id) {
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
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Select Employee</label>
				<select name="se_employee" id="sr_employee" class="form-control input-sm" required>
					<option value="">Select Department First</option>
				
				</select>
			</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Paid amount:</label>
              <input type="text" class="form-control input-sm" name="se_paidamount" id="se_paidamount" value="<?php
              if (!empty($row->se_paidamount)) {
                echo $row->se_paidamount;
              }
              ?>" placeholder="Expense amount*"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Expense amount:</label>
              <input type="text" class="form-control input-sm" name="se_eamount" id="se_eamount" value="<?php
              if (!empty($row->se_eamount)) {
                echo $row->se_eamount;
              }
              ?>" placeholder="Expense amount*"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Amount to be paid / Refund:</label>
              <input type="text" class="form-control input-sm" name="se_pamount" id="se_pamount" value="<?php
              if (!empty($row->se_pamount)) {
                echo $row->se_pamount;
              }
              ?>" placeholder="Amount to be paid *"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>TA Bil No:</label>
              <input type="text" class="form-control input-sm" name="se_tabillno" id="sr_rpaiddate" value="<?php
              if (!empty($row->se_tabillno)) {
                echo $row->se_tabillno;
              }
              ?>" placeholder="TA Bill No	*"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Ta Bill date:</label>
              <input type="text" class="form-control input-sm" name="se_tadate" id="sr_mparticulars" value="<?php
              if (!empty($row->se_tadate)) {
                echo $row->se_tadate;
              }
              ?>" placeholder="YY-MM-DD *"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Material recieved:</label>
              <input type="text" class="form-control input-sm" name="se_rmaterial" value="<?php
              if (!empty($row->se_rmaterial)) {
                echo $row->se_rmaterial;
              }
              ?>" placeholder="Material Recieved *" >
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Material perticulars:</label>
              <input type="text" class="form-control input-sm" name="se_mperticulars" id="se_mperticulars" value="<?php
              if (!empty($row->se_mperticulars)) {
                echo $row->se_mperticulars;
              }
              ?>" placeholder="Perticulars *"  >
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Quantity utilization on:</label>
              <input type="text" class="form-control input-sm" name="se_uquantity" id="se_uquantity" value="<?php
              if (!empty($row->se_uquantity)) {
                echo $row->se_uquantity;
              }
              ?>" placeholder="Quantity *"  >
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Uom:</label>
              <input type="text" class="form-control input-sm" name="se_uom" id="se_uom" value="<?php
              if (!empty($row->se_uom)) {
                echo $row->se_uom;
              }
              ?>" placeholder="UOM *"  >
			  
            </div>
            </div>
			
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Unit Price:</label>
              <input type="text" class="form-control input-sm" name="se_uprice" id="se_uprice" value="<?php
              if (!empty($row->se_uprice)) {
                echo $row->se_uprice;
              }
              ?>" placeholder="Unit price *"  >
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Total price:</label>
              <input type="text" class="form-control input-sm" name="se_totalprice" id="se_totalprice" value="<?php
              if (!empty($row->se_totalprice)) {
                echo $row->se_totalprice;
              }
              ?>" placeholder="Total price *" >
			  
            </div>
            </div>
			
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Material return quantity:</label>
              <input type="text" class="form-control input-sm" name="se_rquantity" id="se_rquantity" value="<?php
              if (!empty($row->se_rquantity)) {
                echo $row->se_rquantity;
              }
              ?>" placeholder="Material return quantity *"  >
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Material Return date:</label>
              <input type="date" class="form-control input-sm" name="se_rdate" id="se_rdate" value="<?php
              if (!empty($row->se_rdate)) {
                echo $row->se_rdate ;
              }
              ?>" placeholder="YY-MM-DD*"  >
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <?php if (!empty($_REQUEST['sr_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updateexpense" />
                <input type="hidden" name="sr_id" value="<?= $row->sr_id; ?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-success">
                <input type="hidden" name="submit" value="addexpense" />
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
										<th>Employee</th>
										<th>Expense Amount</th>
										<th>amount To be paid/Refund</th>
										<th>TA Bill No</th>
										<th>TA Bill Date</th>
										<th>Material Recieved</th>
										<th>Material perticulars</th>
										<th>Quantity Utilization On</th>
										<th>UOM</th>
										<th>Unit price</th>
										<th>Total price</th>
										<th>Return Quantity</th>
										<th>Material Return date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM `expense`" );
									while ( $value = $data->fetch_object() ) {
										$sl++;
										?>
									<tr>
										<td>
											<?= $sl; ?>
										</td>
										<td><?php
											echo	$s_id = $value->se_site;
												// $sqlc = $db->query("select * from site WHERE s_id = '$s_id'");
												// if((mysqli_num_rows($sqlc)) > 0) {
												// $queryc = $sqlc->fetch_object();
												// echo $queryc->s_sitename;
												// }
										?></td>	
									
										<td><?php
												$e_id = $value->se_employee;
												$sqld = $db->query("select * from employee WHERE e_id = '$e_id'");
												if((mysqli_num_rows($sqld)) > 0) {
												$queryd = $sqld->fetch_object();
												echo $queryd->e_name;
												}
										?></td>	
										<td><?= $value->se_eamount; ?></td>	
										<td><?= $value->se_pamount; ?></td>	
										<td><?= $value->se_tabillno; ?></td>	
										<td><?= $value->se_tadate; ?></td>	
										<td><?= $value->se_rmaterial; ?></td>
										<td><?= $value->se_mperticulars; ?></td>
										<td><?= $value->se_uquantity; ?></td>
										<td><?= $value->se_uom; ?></td>
										<td><?= $value->se_uprice; ?></td>
										<td><?= $value->se_totalprice; ?></td>
										<td><?= $value->se_rquantity; ?></td>
										<td><?= $value->se_rdate; ?></td>
										<td>
												<a href="?sr_id=<?= $value->se_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
												<a href="pages/action-expense.php?se_id=<?= $value->se_id; ?>&submit=delete" class="btn btn-danger btn-xs" onClick="return confirm('Are You Sure want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
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

	$('#se_eamount').keyup(function () {
	paidamount = $('#se_paidamount').val();
	expense = $(this).val();
	if(paidamount > expense){
	refund = expense - paidamount;
	} else {
	refund = paidamount - expense;
	}

	$('#se_pamount').val(refund.toFixed(2));	
	});

		
	$( '#s_siteid' ).on( 'change', function () {
			var siteID = $( this ).val();
			if ( siteID ) {
				$.ajax( {
					type: 'POST',
					url: 'ajax_site.php',
					data: 'pid=' + siteID,
					dataType: "json",
					success: function ( html ) {//alert('html');
						$( '#se_site' ).val( html['site'] );
						$( '#sr_scope' ).val( html['scope'] );
					//	$( '#sr_sscope' ).val( html['subscope'] );
					}
				} );
			} 
		} );

		$( '#s_siteid' ).on( 'change', function () {
			var siteID = $( this ).val();
			if ( siteID ) {
				$.ajax( {
					type: 'POST',
					url: 'ajax_rsubscope.php',
					data: 'pid=' + siteID,
					dataType: "json",
					success: function (info) {//alert(info);
						$('#sr_sscope').val(info['subscope']);
						$('#se_paidamount').val(info['expence']);
					}
				});
				}
	} );

	// $( '#se_site' ).on( 'change', function () {
	// 		var siteID = $( this ).val();
	// 		if ( siteID ) {
	// 			$.ajax( {
	// 				type: 'POST',
	// 				url: 'ajax_sitedetails.php',
	// 				data: 'pid=' + siteID,
	// 				dataType: "json",
	// 				success: function (info) {//alert(info);
	// 					$('#se_employee').val(info['ename']);
	// 					$('#se_paidamount').val(info['paidamount']);
						
	// 				}
	// 			});
	// 			}
	// } );

	$( '#sr_department' ).on( 'change', function () {
			var productID = $( this ).val();
			if ( productID ) {
				$.ajax( {
					type: 'POST',
					url: 'ajax_employee.php',
					data: 'pid=' + productID,
					success: function ( html ) {
						$( '#sr_employee' ).html( html );
					}
				} );
			} else {
				$( '#sr_employee' ).html( '<option value="">Choose Department First</option>' );
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

<script>
	/*Auto Complete*/
	$(function() {
		var availableNames = <?=$mnamesJSN?>;
		$('#s_siteid').autocomplete({
			source: availableNames
		});
	});
</script>