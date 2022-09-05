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
	$srid=$_REQUEST['sr_id'];
	$data = $db->query( "SELECT * FROM `requisition` where sr_id = '$srid'" );
	$value = $data->fetch_object() ;
	$site=$value->sr_site;

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Material details</title>
		<?php include_once 'header.php'; ?>
		<style>
			.no-sort::after { display: none!important;}
		</style>
		<div id="page-wrapper">
			<?php include_once 'msg.php'; ?>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header text-info">Material details Of Site  <?= $site; ?></h2>
				</div>
				<!-- /.col-lg-12 --> 
			</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
		<div class="col-lg-12 col-md-12 col-xs-12">
          <?php
          if (empty($_REQUEST['rm_id'])) {
            $s_id = '0';
          } else {
            $s_id = $_REQUEST['rm_id'];
          }
          $results = $db->query("SELECT * FROM re_materials WHERE rm_id = '$s_id'");
          $row = $results->fetch_object();
          ?>
          <form name="frm" id="frm" action="pages/action-material.php" enctype="multipart/form-data" method="post" autocomplete="off">

			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Material perticulars:</label>
              <input type="text" class="form-control input-sm" name="rm_mparticulars" id="rm_mparticulars" value="<?php
              if (!empty($row->rm_mparticulars)) {
                echo $row->rm_mparticulars;
              }
              ?>" placeholder="Material perticulars *">
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>Quantity:</label>
              <input type="text" class="form-control input-sm" name="rm_quantity" value="<?php
              if (!empty($row->rm_quantity)) {
                echo $row->rm_quantity;
              }
              ?>" placeholder="Quantity *" >
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
            <div class="form-group">
              <label>UOM:</label>
              <input type="text" class="form-control input-sm" name="rm_uom" id="sr_uom" value="<?php
              if (!empty($row->rm_uom)) {
                echo $row->rm_uom;
              }
              ?>" placeholder="UOM *"  >
			  
            </div>
            </div>
			<div class="col-lg-3 col-md-3 col-xs-12">
				<div class="form-group">
				<label>Unit price:</label>
				<input type="text" class="form-control input-sm" name="rm_unitprice" id="rm_unitprice" value="<?php
				if (!empty($row->rm_unitprice)) {
					echo $row->rm_unitprice;
				}
				?>" placeholder="Unit price *">
				
				</div>
            </div>
		
		</div>
		
		<!-- <div class="col-lg-3 col-md-3 col-xs-12">
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
              <?php if (!empty($_REQUEST['rm_id'])) { ?>
              <input type="submit" name="submitf" id="submit" value="Update" class="btn btn-success">
                <input type="hidden" name="submit" value="updaterematerial" />
                <input type="hidden" name="rm_id" value="<?= $row->rm_id; ?>" />
                <input type="hidden" name="rm_rsid" value="<?= $srid;?>" />
              <?php } else { ?>
              <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-success">
                <input type="hidden" name="submit" value="addrematerial" />
                <input type="hidden" name="rm_srid" value="<?= $srid;?>" />
              <?php } ?>
            </div>
            </div>
          </form>
        </div>
		
		<div class="col-lg-12 col-md-12 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="dataTable_wrapper">
							<table width="100%" class="table table-striped table-bordered table-hover table-condensed" id="">
								<thead>
									<tr>
										<th class="no-sort">Sl.</th>
										<th>Material Perticulars</th>
										<th>Quantity</th>
										<th>Uom</th>
										<th>Unit price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sl = 0;
									$psubtotal = 0;
									$data = $db->query( "SELECT * FROM `re_materials`" );
									while ( $value = $data->fetch_object() ) {
									$psubtotal = $psubtotal+$value->rm_uprice;
									$sl++;
									?>
									<tr>
										<td>
											<?= $sl; ?>
										</td>
										<td><?= $value->rm_mparticulars; ?></td>	
										<td><?= $value->rm_quantity; ?></td>	
										<td><?= $value->rm_uom; ?></td>	
										<td><?= $value->rm_uprice; ?></td>
										<td>
													
												<a href="?rm_id=<?= $value->rm_id; ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
												<a href="pages/action-material.php?rm_id=<?= $value->rm_id; ?>&submit=delete" class="btn btn-danger btn-xs" onClick="return confirm('Are You Sure want to delete ?')"><i class="fa fa-trash" aria-hidden="true"></i> </a>
												
										</td>
									
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<table width="100%" class="table table-bordered table-hover text-right" id="">
									<tbody>
									<form name="frm" id="frm" action="pages/action-material.php" enctype="multipart/form-data" method="post" autocomplete="off">
								
										<tr>
											<td>
												<h5>Sub Total <i class="fa fa-inr fa-fw"></i></h5>
												</td>
												<td>
													<input readonly class="form-control input-sm" name="sr_totalprice" id="psubtotal" value="<?= $psubtotal; ?>">
												</td>
												<td>  
													 <input type="submit" name="submitf" id="submit" value="Save" class="btn btn-info">
              					  					<input type="hidden" name="submit" value="updatemtotal" />
                <input type="hidden" name="rm_srid" value="<?= $srid;?>" /></td>
										</tr>
										
													
									</form>
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