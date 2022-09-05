<!--<div class="navbar-header" style="padding:10px 10px;color:#ffffff;float:right!important;">	
	Copyright © <?php //date('Y')?> <a onmouseover='this.style.color="yellow"' 
    onmouseout='this.style.color="cyan"' href="https://www.shopweb.in/">SHOPWEB(O) PVT. LTD.</a> All Rights Reserved.  
</div>-->
</div>
<!-- /#wrapper -->
<?php
$db->close();
$_SESSION['msg'] = '0';
?>
<!-- jQuery -->
<!--<script src="bower_components/jquery/dist/jquery.min.js"></script> -->

<!-- Bootstrap Core JavaScript -->
<script src="components/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="components/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="components/jquery.dataTables.min.js"></script>
<script src="components/dataTables.bootstrap.min.js"></script>
<script src="components/dataTables.responsive.js"></script>
<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

<!-- download file buttons -->
<script type="text/javascript" src="components/bootstrapbuttons/dataTables.buttons.min.js" />
</script>
<script type="text/javascript" src="components/bootstrapbuttons/buttons.flash.min.js" />
</script>
<script type="text/javascript" src="components/bootstrapbuttons/jszip.min.js" />
</script>
<script type="text/javascript" src="components/bootstrapbuttons/pdfmake.min.js" />
</script>
<script type="text/javascript" src="components/bootstrapbuttons/vfs_fonts.js" />
</script>
<script type="text/javascript" src="components/bootstrapbuttons/buttons.html5.min.js" />
</script>
<script type="text/javascript" src="components/bootstrapbuttons/buttons.print.min.js" />
</script>

<link href="components/bootstrapbuttons/jquery.dataTables.min.css" rel="stylesheet">
<link href="components/bootstrapbuttons/buttons.dataTables.min.css" rel="stylesheet">
<!--Page-Level Demo Scripts - Tables - Use for reference -->
<script>
  $(document).ready(function () {
    $('#dataTables-example').DataTable({
      "scrollX": true,
      dom: 'Bfrtip',
      buttons: [
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
      ]
    });
  });
</script>

<script>
  // tooltip demo
  $('.tooltip-demo').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
  })

  // popover demo
  $("[data-toggle=popover]")
    .popover()
</script>
<script type="text/javascript" src="dist/js/moment.min.js"></script>
<script type="text/javascript" src="dist/js/daterangepicker.js"></script>

</body>

</html>
<?php ob_end_flush(); ?>