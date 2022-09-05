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
            <label>Select Page:</label>
            <div class="row">

              <div class="col-xs-6 col-sm-4">
                <label class="checkbox-inline" style="font-size:12px;">
                  <input type="checkbox" value="1" <?php
                  foreach (explode(',', $row->a_pagepermission) as $n) {
                    if ($n == '1') {
                      echo 'checked';
                    }
                  }
                  ?> name="a_pagepermission[]">
                  Master Section</label>
              </div>
              <div class="col-xs-6 col-sm-4">
                <label class="checkbox-inline" style="font-size:12px;">
                  <input type="checkbox" value="2" <?php
                  foreach (explode(',', $row->a_pagepermission) as $n) {
                    if ($n == '2') {
                      echo 'checked';
                    }
                  }
                  ?> name="a_pagepermission[]">
                  Emploee Create</label>
              </div>
              <div class="col-xs-6 col-sm-4">
                <label class="checkbox-inline" style="font-size:12px;">
                  <input type="checkbox" value="3" <?php
                  foreach (explode(',', $row->a_pagepermission) as $n) {
                    if ($n == '3') {
                      echo 'checked';
                    }
                  }
                  ?> name="a_pagepermission[]">
                 Employee attendance</label>
              </div>
                      <div class="col-xs-6 col-sm-4">
                <label class="checkbox-inline" style="font-size:12px;">
                  <input type="checkbox" value="4" <?php
                  foreach (explode(',', $row->a_pagepermission) as $n) {
                    if ($n == '4') {
                      echo 'checked';
                    }
                  }
                  ?> name="a_pagepermission[]">
                Salary</label>
              </div>
                     <div class="col-xs-6 col-sm-4">
                <label class="checkbox-inline" style="font-size:12px;">
                  <input type="checkbox" value="5" <?php
                  foreach (explode(',', $row->a_pagepermission) as $n) {
                    if ($n == '5') {
                      echo 'checked';
                    }
                  }
                  ?> name="a_pagepermission[]">
                 Site work</label>
              </div>
                </div>
            <br>
            <div class="form-group">
              <div class="col-sm-8">
                <button type="submit" class="btn btn-primary">Apply</button>
                <input type="hidden" name="submit" value="UserPermission" />
                <input type="hidden" name="a_id" value="<?= $a_id; ?>" />
              </div>
            </div>
          </form>
        </div>
      </div>
      <br/>
    </div>
  <?php } ?>
