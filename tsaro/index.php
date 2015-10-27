<?php require_once("../inc/initialize.php"); 
	//checks if admin user is logged in 
	$session->logout();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php require_once(LIB_PATH.DS.'css.php'); ?>
</head>
<body>
<?php include_layout_template("header.php"); ?>
<?php include_layout_template("main_nav.php"); ?> 
<!-- beginnning of main content-->
<div class="container">
	<div class="row-fluid">
		
		<div class="tab-pane fade in active offset2" id="home">
	      
	      <?php include_layout_template("admin_login_form.php"); ?>
	      
	    </div> 
		
	</div>
</div>

<?php include_layout_template("footer.php"); ?>
</body>
</html>

<?php require_once(LIB_PATH.DS.'javascript.php'); ?>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/adminlog.js"></script> 
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
      <div class="modal-body ajax_data"></div>
      <div class="modal-footer">
         <a href="#" class="btn" id="close">Close</a>
 </div> 
 </div>