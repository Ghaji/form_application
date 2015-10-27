<?php require_once("inc/initialize.php");

// if($session->is_logged_in()){
// 		redirect_to('select_form.php');
// 	}
// elseif(!isset($_GET[md5('id')]))
// {
// 	redirect_to('index.php');
// }
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
<!--The Main Content Here Please-->


<!-- beginnning of main content-->
<div class="container">
	<div class="row-fluid">
		<div class="span8 create" >
        
			<?php
				include_layout_template("refereeform.php");
			?>
	
		</div>
		
		<div class="span4">		
			<div class="create" >
				<h5 align="center">Filling the Referee Form</h5>
				<hr>
                <p class="pad">
                Use the Guide-line below to Fill the referee form.</p>
                <ul><li><span class="label label-success">Filling the Referee Form</span></li></ul>
                <ol>
                <li>Fill this form only if you know the applicant.</li>
                <li>All fields are required.</li>
                <li>To fill the questionaire click on each option button</li>
                <li>To submit the form click on the save button.</li>
                <li>To exit and fill the form later click on the exit button.</li>
                </ol>

			</div>
		</div>
	</div>
</div>
<!--The Main Content Here Please-->
<?php include_layout_template("footer.php"); ?>
</body>
</html>

<?php require_once(LIB_PATH.DS.'javascript.php'); ?>

<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/referee_form.js"></script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
      <div class="modal-body ajax_data"></div>
      <div class="modal-footer">
         <a href="#" class="btn" id="close">Close</a>
 </div> 
 </div>