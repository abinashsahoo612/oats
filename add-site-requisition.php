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
		<title>Site Requisition</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Site Requisition </h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-12 col-md-12 col-xs-12">
          <?php
          if (empty($_REQUEST['sr_id'])) {
            $s_id = '0';
          } else {
            $s_id = $_REQUEST['sr_id'];
          }
          $results = $db->query("SELECT * FROM requisition WHERE sr_id = '$s_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="pages/action-requisition.php" enctype="multipart/form-data" method="post" autocomplete="off">
		  <div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Site ID:</label>
			  <!-- <input  type="text" class="form-control input-sm" id="s_siteid" name="s_siteid" value="<?php //if (!empty($row->sr_id)) {
					//echo $row->sr_site;
				//}
				?>" placeholder=""> -->
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
							</datalist>
            </div>
		</div>
		<div class="col-lg-3 col-md-3 col-xs-12">
		  <div class="form-group">
				<label>Site Name</label>

				<input  type="text" class="form-control input-sm" id="sr_site" name="sr_site" value="<?php if (!empty($row->sr_site)) {
					echo $row->sr_site;
				}
				?>" placeholder="Site Name" readonly>
			</div>
			</div>
			<div class="col-lg-3 col-md-3 col-xs-12">
			<div class="form-group">
				<label>Select Department </label>
				<select name="sr_department" id="sr_department" class="form-control input-sm" required>
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
				<!-- <input  type="text" class="form-control input-sm" id="sr_employee" name="sr_employee" value="<?php if (!empty($row->sr_employee)) {
					echo $row->sr_employee;
				}
				?>" placeholder="Employee Name" > -->
										<?php
											// $sqle = $db->query("SELECT * FROM employee WHERE e_status='1'");
											// if (mysqli_num_rows($sqle) > 0) {
											// 	while ($querye = $sqle->fetch_object()) {
											// 		$mnamese[]=$querye->e_name;
											// 		$employeeJSN=json_encode($mnamese);
											// 	}
											// }
										?>
				<select name="sr_employee" id="sr_employee" class="form-control input-sm" required>
					<option value="">Select Employee</option>
				
				</select>
			</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Requisition For Approval:</label>
              <input type="text" class="form-control input-sm" name="sr_rapproval" id="sr_rapproval" value="<?php
              if (!empty($row->sr_rapproval)) {
                echo $row->sr_rapproval;
              }
              ?>" placeholder="Requisition For Approval *"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Requisition Date:</label>
              <input type="date" class="form-control input-sm" name="sr_rdate" id="s_cunitprice" value="<?php
              if (!empty($row->sr_rdate)) {
                echo $row->sr_rdate;
              }
              ?>" placeholder="YY-MM-DD*"  required>
            </div>
            </div>
			
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Scope:</label>
              <input readonly type="text" class="form-control input-sm" name="sr_scope" id="sr_scope" value="<?php
              if (!empty($row->sr_scope)) {
                echo $row->sr_scope;
              }
              ?>" placeholder="Scope*"  required>
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Sub Sub Scope:</label>

			  
				<select name="sr_subscope" id="sr_subscope" class="form-control input-sm " required>
							<option value=""> Choose Site First</option>
							<!--Sub category goes here-->
							<?php 
									if (!empty($row->sr_subscope)) {
									$l_id = $row->sr_subscope;
									$sqlt1 = $db->query("select * from subscope WHERE sc_id = '$l_id'");
									while ($queryt1 = $sqlt1->fetch_object()) {
							?>
							<option <?php if($row->sr_subscope == $queryt1->sc_id){ echo 'selected';} ?> value="
								<?= $queryt1->sc_id; ?>">
								<?= $queryt1->sc_name; ?>
							</option>
							<?php  } }?>
				</select>
             
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Requisition Paid date:</label>
              <input type="date" class="form-control input-sm" name="sr_rpaiddate" id="sr_rpaiddate" value="<?php
              if (!empty($row->sr_rpaiddate)) {
                echo $row->sr_rpaiddate;
              }
              ?>" placeholder="YY-MM-DD *"  >
			  
            </div>
            </div>

			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Material Paid date:</label>
              <input type="date" class="form-control input-sm" name="sr_mpaiddate" id="sr_mpaiddate" value="<?php
              if (!empty($row->sr_mpaiddate)) {
                echo $row->sr_mpaiddate;
              }
              ?>" placeholder="Material Paid date *"  >
            </div>
            </div>
			
            </div>
<!-- -->
		<!-- <div class="row" id="material">
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Material perticulars:</label>
              <input type="text" class="form-control input-sm" name="sr_mparticulars" id="sr_mparticulars" value="<?php
              if (!empty($row->sr_mparticulars)) {
                echo $row->sr_mparticulars;
              }
              ?>" placeholder="Material perticulars *">
            </div>
            </div>
			<div class="col-lg-2 col-md-2 col-xs-12">
            <div class="form-group">
              <label>Quantity:</label>
              <input type="text" class="form-control input-sm" name="sr_quantity" value="<?php
              if (!empty($row->sr_quantity)) {
                echo $row->sr_quantity;
              }
              ?>" placeholder="Quantity *" >
            </div>
            </div>
			<div class="col-lg-2 col-md-2 col-xs-12">
            <div class="form-group">
              <label>UOM:</label>
              <input type="text" class="form-control input-sm" name="sr_uom" id="sr_uom" value="<?php
              if (!empty($row->sr_uom)) {
                echo $row->sr_uom;
              }
              ?>" placeholder="UOM *"  >
			  
            </div>
            </div>
			<div class="col-lg-2 col-md-2 col-xs-12">
				<div class="form-group">
				<label>Unit price:</label>
				<input type="text" class="form-control input-sm" name="sr_unitprice" id="sr_unitprice" value="<?php
				if (!empty($row->sr_unitprice)) {
					echo $row->sr_unitprice;
				}
				?>" placeholder="Unit price *">
				
				</div>
            </div>
			<div class="col-lg-2 col-md-2 col-xs-12">
				<a class="btn btn-success btn-xs" id="add"><i class="fa fa-plus" aria-hidden="true" style="width:100%;height:100%;"></i></a>
			</div>
		</div>
			
		<div class="new">
		</div>
		<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Total price:</label>
             	 <input type="text" class="form-control input-sm" name="sr_totalprice" id="sr_totalprice" value="<?php
              	if (!empty($row->sr_totalprice)) {
                echo $row->sr_totalprice;
              	}
              ?>" placeholder="Total price *">
            </div>
		</div> -->
<!-- -->


			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <?php if (!empty($_REQUEST['sr_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updaterequisition" />
                <input type="hidden" name="sr_id" value="<?= $row->sr_id; ?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-success">
                <input type="hidden" name="submit" value="addrequisition" />
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
										<th>Material Details</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$data = $db->query( "SELECT * FROM `requisition`" );
									while ( $value = $data->fetch_object() ) {
									$sl++;
									?>
									<tr>
										<td>
											<?= $sl; ?>
										</td>
										<td><?php
												echo $s_id = $value->sr_site;
												// $sqlc = $db->query("select * from site WHERE s_id = '$s_id'");
												// if((mysqli_num_rows($sqlc)) > 0) {
												// $queryc = $sqlc->fetch_object();
												// echo $queryc->s_sitename;
												// }
										?></td>	
									
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
										<td>
													
												<a href="add-material?sr_id=<?= $value->sr_id; ?>" class="btn btn-info btn-xs"> Material Details
												</a>
										</td>
										<td>
													
												<a href="?sr_id=<?= $value->sr_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
												<a href="pages/action-requisition.php?sr_id=<?= $value->sr_id; ?>&submit=delete" class="btn btn-danger btn-xs" onClick="return confirm('Are You Sure want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
												
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
		$( '#sr_site' ).keyup( function () {
			var siteID = $( '#s_siteid' ).val();
			if ( siteID ) {
				$.ajax( {
					type: 'POST',
					url: 'ajax_subscope.php',
					data: 'pid=' + siteID,
					success: function ( html ) {//alert(html);
						$( '#sr_subscope' ).html( html);
					//	$( '#sr_sscope' ).val( html['scope'] );
					}
				} );
			}
		} );

		
		$( '#s_siteid' ).on( 'change', function () { 
			var siteID = $('#s_siteid').val();
			if ( siteID ) {
				$.ajax( {
					type: 'POST',
					url: 'ajax_site.php',
					data: 'pid=' + siteID,
					dataType: "json",
					success: function ( html ) {//alert(html);
						$( '#sr_site' ).val( html['site'] );
						//$( '#sr_subscope' ).html( html['subscope'] );
						$( '#sr_scope' ).val( html['scope'] );
					}
				} );
			} 
		} );
		
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




	} );
	
	$(document).ready(function(){
  
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

  
  $("#add").click(function(){   
			$("#material").clone(true).append( $('<div class="col-md-2"><a class="btn btn-danger btn-xs" id="remove"><i class="fa fa-minus" aria-hidden="true" style="width:100%;height:100%;"></i></a></div>') ).appendTo(".new");  
		});
		$("#remove").click(function () {
			$(this).closest("#material").remove();
			e.preventDefault();
		});
  
});
	
</script>

<script>
	/*Auto Complete*/
	// $(function() {
	// 	var availableNames = <?php //$mnamesJSN?>;
	// 	$('#s_siteid').autocomplete({
	// 		source: availableNames
	// 	});
		
		// $('#sr_employee').autocomplete({
		// 	source: employee
		// });
	//});
	// $(function() {
	// });
</script>