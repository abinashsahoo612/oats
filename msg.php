<?php
if (empty($_SESSION['msg'])) {
  $_SESSION['msg'] = '0';
} else {
  $e_msg = $_SESSION['msg'];
  ?>
  <div class="col-md-8 col-md-offset-2">
    <style>
      #msg { position: absolute; z-index:33; width:100%; border-radius:5px; border:0; margin-top:5px; text-align:center; }
      .alert {
        padding:5px 10px;
        font-size:12px;
      }
      .alert-success {
        color: #fff;
        background-color: #4CB844;
        border-color: #468847;
      }
      .alert-warning {
        color: #fff;
        background-color: #FB7E02;
        border-color: #DF7C00;
      }
      .alert-danger,
      .alert-error {
        color: #fff;
        background-color: #DC494C;
        border-color: #b94a48;
      }
    </style>
    <?php if ($e_msg === md5('1')) { ?>
      <div class="alert alert-success" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Successfully logout. </div>
    <?php } ?>
    <?php if ($e_msg === md5('2')) { ?>
      <div class="alert alert-danger" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Your username and password don't match. </div>
    <?php } ?>
    <?php if ($e_msg === md5('3')) { ?>
      <div class="alert alert-success" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Your password has been changed successfully! Thank you. </div>
    <?php } ?>
    <?php if ($e_msg === md5('4')) { ?>
      <div class="alert alert-success" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Your password has been reset successfully. </div>
    <?php } ?>
    <?php if ($e_msg === md5('5')) { ?>
      <div class="alert alert-success" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Successfully Added. </div>
    <?php } ?>
    <?php if ($e_msg === md5('6')) { ?>
      <div class="alert alert-success" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Successfully Updated. </div>
    <?php } ?>
    <?php if ($e_msg === md5('7')) { ?>
      <div class="alert alert-warning" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Successfully Removed. </div>
    <?php } ?>
    <?php if ($e_msg === md5('8')) { ?>
      <div class="alert alert-warning" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Already exists. </div>
    <?php } ?>
    <?php if ($e_msg === md5('9')) { ?>
      <div class="alert alert-success" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> You have successfully logged in. </div>
    <?php } ?>
    <?php if ($e_msg === md5('10')) { ?>
      <div class="alert alert-warning" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Your password and confirm password don't match. </div>
    <?php } ?>
    <?php if ($e_msg === md5('11')) { ?>
      <div class="alert alert-warning" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Something went wrong. </div>
    <?php } ?>
    <?php if ($e_msg === md5('12')) { ?>
      <div class="alert alert-success" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Installation ID successfully generated. </div>
    <?php } ?>
    <?php if ($e_msg === md5('13')) { ?>
      <div class="alert alert-success" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Successfully Published. </div>
    <?php } ?>
    <?php if ($e_msg === md5('14')) { ?>
      <div class="alert alert-warning" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> This Period Already Assigned. </div>
    <?php } ?>
	<?php if ($e_msg === md5('15')) { ?>
      <div class="alert alert-warning" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Purchase Items already Sold Out , Can't modified </div>
    <?php } ?>
	<?php if ($e_msg === md5('16')) { ?>
      <div class="alert alert-warning" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Sale Quantity Should be less than Total Stock </div>
    <?php } ?>
    <?php if ($e_msg === md5('17')) { ?>
      <div class="alert alert-warning" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Invoice No Not Found </div>
    <?php } ?>
     <?php if ($e_msg === md5('18')) { ?>
      <div class="alert alert-warning" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Invoice No Not Found </div>
    <?php } ?>
     <?php if ($e_msg === md5('19')) { ?>
      <div class="alert alert-success" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Form Submitted </div>
    <?php } ?>
	
     <?php if ($e_msg === md5('20')) { ?>
      <div class="alert alert-success" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Booked Successfully </div>
    <?php } ?>
     <?php if ($e_msg === md5('21')) { ?>
      <div class="alert alert-warning" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> Submit previous Attendance </div>
    <?php } ?>
    
    <?php if ($e_msg === md5('22')) { ?>
      <div class="alert alert-warning" id="msg"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> No Employee Selected</div>
    <?php } ?>
  </div>
<?php } ?>
<script>
  $(document).ready(function () {
    $('div#msg').delay(3000).slideUp();
  });
</script>