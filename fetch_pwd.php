<?php
session_start();
require_once 'config/config.php';
require_once 'config/helper.php';
if ($_POST['rowid']) {
  $a_id = $_POST['rowid']; //escape string
  $results = $db->query("SELECT * FROM admin WHERE a_id = '$a_id'");
  $row = $results->fetch_object();
  ?>

  <div class="row">
    <div class="col-sm-12">

      <div class="panel panel-default" style="border:none;">
        <div class="panel-head">
          <center>
            <h4><?php echo $row->a_name; ?></h4>
          </center>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" action="pages/action-user" enctype="multipart/form-data" method="post">
            <div class="form-group">
              <label class="col-sm-4 control-label">New Password</label>
              <div class="col-sm-8">
                <input class="form-control" placeholder="" name="a_pwd" type="password">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">Confirm Password</label>
              <div class="col-sm-8">
                <input class="form-control" placeholder="" name="confirm_a_pwd" type="password">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-primary">Change</button>
                <input type="hidden" name="submit" value="ChangeUserPwd" />
                <input type="hidden" name="a_id" value="<?= $a_id; ?>" />
              </div>
            </div>
          </form>
        </div>
      </div>
      <br/>

    </div>
  <?php } ?>
