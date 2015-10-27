<?php require_once("inc/initialize.php"); 
$settings=new Settings();

if(!($settings->isApplicationOpen()))
{
	redirect_to('index.php');
}

if($session->is_logged_in()){
	
	redirect_to('select_form.php');
}
	
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php require_once(LIB_PATH.DS.'css.php'); ?>
<link  href="css/ddajaxsidepanel.css" rel="stylesheet" type="text/css" />
        
<?php 
ini_set('session.use_trans_sid', '0');
// Include the random string file
require 'rand.php'; 
//Set the session contents
$_SESSION['captcha_id'] = $str;
?>
</head>
<body>
<?php include_layout_template("header.php"); ?>
<!--The Main Content Here Please-->

<!-- beginnning of main content-->
<div class="container">
	<div class="row-fluid">
		<div class="span7 create" >
        
			<?php
				include_layout_template("registrationform.php");
			?>
	
		</div>
		
		<div class="span5">		
			<div class="create" >
				<h5 align="center">How to Create an Account</h5>
				<hr>
                <p class="pad">
                Use the Guide-line below to Create an account and also pay for the form online using our payment gate-way.</p>
                <ul><li><span class="label label-success">Create and account and make payment</span></li></ul>
                <ol>
                <li>Create an Account if you don't already have.</li>
                <li>You can only have one account</li>
                <li>If you apply more than once you stand the risk of being disqualified</li>
                <li>After filling all the required fields, check your mail inbox (or spam) for the validation mail</li>
                <li>click on the link and verify your email address</li>
                <li>If you don't verify your account within two weeks, your account will be deleted</li>
                </ol>
                
                <ul><li><span class="label label-success">Login to continue registration</span></li></ul>
                <ol>
                <li>Login using your e-mail and password to continue registration</li>
                <li>You can save and continue anytime but most finish before closing date </li>
                <li>If you successfully finish your registration please print a copy of the print a copy and send it to  </li>
                <li>Proceed to the payment engine and enter your card details</li>
                <li>Then print your reciept and  </li>
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
<script src="js/create_account.js"></script>
<script src="js/ddajaxsidepanel.js" type="text/javascript"></script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
      <div class="modal-body ajax_data"></div>
      <div class="modal-footer">
         <a href="#" class="btn" id="close">Close</a>
 </div> 
 </div>