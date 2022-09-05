<link href="components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="components/metisMenu.min.css" rel="stylesheet">
<link href="components/dataTables.bootstrap.css" rel="stylesheet">
<link href="components/dataTables.responsive.css" rel="stylesheet">
<link href="dist/css/sb-admin-2.css" rel="stylesheet">
<link href="dist/css/style.css" rel="stylesheet">
<link href="components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="dist/css/datepicker.css" rel="stylesheet">
<link href="dist/css/csss.css" rel="stylesheet">
<script src="https://cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>
<!-- jQuery -->
<script src="dist/js/jquery-1.11.1.min.js"></script>
<script src="dist/js/datepicker.js"></script>
<!-- jQuery -->
<!-- hindi editor -->
 <script src="http://www.hinkhoj.com/common/js/keyboard.js"></script>
    <link rel="stylesheet" type="text/css"
    href="http://www.hinkhoj.com/common/css/keyboard.css" />
</head><body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
		<a class="navbar-brand" href="dashboard" style="color:#f9f9f9;"><strong>ADMIN PANEL</strong></a> </div>
		<!-- /.navbar-header -->

		<ul class="nav navbar-top-links navbar-right">
			<li class="dropdown" style="color:#ffffff;font-weight:bold;"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user fa-fw"></i><?=(!empty($_SESSION['a_email']))?($_SESSION['a_email']):('')?><i class="fa fa-angle-down fa-fw"></i></a>
				<ul class="dropdown-menu dropdown-user">
					<!--<li><a href="admin_profile?a_id=<?=$_SESSION['a_id']?>"><i class="fa fa-user fa-fw"></i> User Profile</a> </li>-->
<!--<li><a href="#" data-toggle="modal" data-target="#myModalprofile"><i class="fa fa-gear fa-fw"></i>&nbsp;&nbsp;User Profile</a></li>-->
					<li><a href="#" data-toggle="modal" data-target="#myModalpwd"><i class="fa fa-gear fa-fw"></i>&nbsp;&nbsp;Change Password</a></li>
					<li class="divider"></li>
					<li><a href="pages/loginaction?submit=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
				</ul>
			</li>
		</ul>
		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">
				<ul class="nav" id="side-menu">
					<li><a href="dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a> </li>
					<?php
						foreach ( explode( ',', $_SESSION[ 'a_pagepermission' ] ) as $perm ) {
							if ( $perm == '1' ) {
					?>
					<li><a href="#"><i class="fa fa-sitemap fa-fw"></i> Master page</a>
						<ul class="nav nav-second-level">
						
					<li><a href="add-department"><i class="glyphicon glyphicon-book"></i>   Add Department</a> </li>
					<li><a href="add-designation"><i class="glyphicon glyphicon-book"></i>  Add Designation</a> </li>
					<li><a href="add-circle"><i class="glyphicon glyphicon-book"></i>  Add Circle</a> </li>
					<li><a href="add-location"><i class="glyphicon glyphicon-book"></i>  Add Location</a> </li>
					<li><a href="add-cluster"><i class="glyphicon glyphicon-book"></i>  Add Cluster</a> </li>
					<li><a href="add-scope"><i class="glyphicon glyphicon-book"></i>  Add Scope</a> </li>
					<li><a href="add-subscope"><i class="glyphicon glyphicon-book"></i>  Add Sub Scope</a> </li>
					<li><a href="add-month"><i class="glyphicon glyphicon-book"></i> Salary Month Setup</a> </li>
					<li><a href="add-samountsetup"><i class="glyphicon glyphicon-book"></i> EPF/ESIC Setup</a> </li>
					<li><a href="add-abreason"><i class="glyphicon glyphicon-book"></i> Manage leave</a> </li>
					<li><a href="add-holiday"><i class="glyphicon glyphicon-book"></i>Add Holiday</a> </li>
					<li><a href="add-holidaydetails"><i class="glyphicon glyphicon-book"></i> Manage Holiday</a> </li>
					</ul>
				</li>


				<?php
						}
						}
				?>
				
				<?php
						foreach ( explode( ',', $_SESSION[ 'a_pagepermission' ] ) as $perm ) {
							if ( $perm == '2' ) {
					?>
					<li><a href="add-employee"><i class="fa fa-sitemap fa-fw"></i>Add Employee</a> </li>

					<?php
						}
						}
				?>

<?php
						foreach ( explode( ',', $_SESSION[ 'a_pagepermission' ] ) as $perm ) {
							if ( $perm == '3' ) {
					?>
					<li><a href="#"><i class="fa fa-sitemap fa-fw"></i> Attendance</a>
						<ul class="nav nav-second-level">
						
					<li><a href="add-emp-attendance"><i class="glyphicon glyphicon-book"></i> Employee Attendance</a> </li>
					<li><a href="attendance-report"><i class="glyphicon glyphicon-book"></i>   Daily Attendance Report</a> </li>
					<li><a href="monthly-attendance-report"><i class="glyphicon glyphicon-book"></i>   Monthly Attendance Report</a> </li>
					<li><a href="leave-report"><i class="glyphicon glyphicon-book"></i>   Leave Report</a> </li>
				</ul>
				</li>

				<?php
						}
						}
				?>

				<?php
						foreach ( explode( ',', $_SESSION[ 'a_pagepermission' ] ) as $perm ) {
							if ( $perm == '4' ) {
					?>
					<li><a href="#"><i class="fa fa-sitemap fa-fw"></i> Salary</a>
						<ul class="nav nav-second-level">
				<li><a href="add-emp-salary"><i class="glyphicon glyphicon-book"></i> Employee Salary</a> </li>
				<li><a href="salary-list"><i class="glyphicon glyphicon-book"></i> 
				Employee Salary List</a> </li>
				<li><a href="monthly-salary-report"><i class="glyphicon glyphicon-book"></i> Monthly Salary Report</a> </li>
				</ul>
				</li>

				<?php
						}
						}
				?>

				<?php
						foreach ( explode( ',', $_SESSION[ 'a_pagepermission' ] ) as $perm ) {
							if ( $perm == '5' ) {
					?>
					<li><a href="#"><i class="fa fa-sitemap fa-fw"></i> Site Section</a>
						<ul class="nav nav-second-level">
				<li><a href="add-site-allottment"><i class="glyphicon glyphicon-book"></i> Site allottment</a> </li>
				<li><a href="add-site-requisition"><i class="glyphicon glyphicon-book"></i> Site Requisition</a> </li>
				<li><a href="add-site-expense"><i class="glyphicon glyphicon-book"></i> Site Expenses</a> </li>
				<li><a href="add-site-billing"><i class="glyphicon glyphicon-book"></i> Site Billing</a> </li>
				
				<li><a href="#"><i class="fa fa-sitemap fa-fw"></i> Report Section</a>
						<ul class="nav nav-second-level">
				<li><a href="requisition-report"><i class="glyphicon glyphicon-book"></i> Requisition Report</a> </li>
				<li><a href="site-allot-report"><i class="glyphicon glyphicon-book"></i> Site Allotment Report</a> </li>
				</ul>
				</li>
				</ul>
				</li>


				<?php
						}
						}
				?>
				<?php if(($_SESSION['a_usertype']) == '1'){ ?>
				<li><a href="#"><i class="fa fa-sitemap fa-fw"></i> User Section</a>
						<ul class="nav nav-second-level">
				<li><a href="add-user"><i class="glyphicon glyphicon-book"></i> Add User</a> </li>
			</ul>
			</li>
			<?php } ?>
			</div>
				<!-- /.sidebar-collapse -->
		</div>
			<!-- /.navbar-static-side -->
	</nav>
	<div class="modal fade" id="myModalpwd" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Change Password</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form" action="pages/action-pwd" enctype="multipart/form-data" method="post">
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
								<button type="submit" class="btn btn-primary">Update</button>
								<input type="hidden" name="submit" value="updatepwd" />
								<input type="hidden" name="a_idchk" value="<?= $a_idchk; ?>" />
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<?php
		$a_id = $_SESSION['a_id'];
		$results = $db->query("SELECT * FROM admin WHERE a_id = '$a_id'");
		$ad_row = $results->fetch_object();
	?>
	<div class="modal fade" id="myModalprofile" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Change Profile</h4>
				</div>
				<div class="modal-body">
					<form name="frm" id="frm" action="pages/action-user.php" enctype="multipart/form-data" method="post" >
						<div class="form-group">
							<label>Email *:</label>
							<input type="email" class="form-control input-sm" name="a_email" value="<?php
								if (!empty($ad_row->a_email)) {
									echo $ad_row->a_email;
								}
							?>" placeholder="Email *" data-error="Bruh, that email address is invalid" required>
						</div>
						<div class="form-group">
							<label>Name: </label>
							<input type="text" class="form-control input-sm" name="a_name" value="<?php
								if (!empty($ad_row->a_name)) {
									echo $ad_row->a_name;
								}
							?>" placeholder="Name *" required>
						</div>
						<div class="form-group">
							<label>Phone: </label>
							<input type="text" class="form-control input-sm" name="a_phone" value="<?php
								if (!empty($ad_row->a_phone)) {
									echo $ad_row->a_phone;
								}
							?>" placeholder="Phone *" required>
						</div>
						<div class="form-group">
							<label>Address:</label>
							<textarea  class="form-control input-sm" name="a_address"  placeholder="Address"><?php
								if (!empty($ad_row->a_address)) {
									echo $ad_row->a_address;
								}
							?>
							</textarea>
						</div>
						<div class="form-group">
							<input type="submit" name="submitf" id="submit" value="Submit" class="btn btn-success">
							<input type="hidden" name="submit" value="updateUser" />
							<input type="hidden" name="a_id" value="<?= $ad_row->a_id; ?>" />
							<input type="hidden" name="a_usertype" value="1" />
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
