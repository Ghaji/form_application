<?php require_once("inc/initialize.php");
$md5mail = md5('email');

//checks if the link is actually from the mail sent 
	if(!isset($_GET[$md5mail]))
	{
		redirect_to('index.php');
	}
	else
	{
		$encryptedmail = $_GET[$md5mail];
		
		$decryptedmail = customDecrypt($encryptedmail);
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php require_once(LIB_PATH.DS.'css.php'); 
?>
</head>
<body>
<?php include_layout_template("header.php"); ?>

<!--The Main Content Here Please-->
<div class="container">
    <div class="form-signin">     
          <h5 align="center">Enter Password for verification</h5>
    <hr>
    <form class="contact-us verify" action="#" >
      <div class="control-group">
        <label class="control-label" for="inputEmail">Password</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-lock"></i></span>
                <input type="password" class="input-xlarge" required id="epassword" name="epassword" placeholder="Enter Password" />
                <input type="hidden" value="<?php echo $decryptedmail; ?>" name="email" id="email" />
            </div>
        </div>
      </div>
      
        <div class="control-group">
        <label class="control-label" ></label>
        <div class="controls">
        
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" onClick="document.location.href='index.php';" class="btn btn-warning">Cancel</button>
        </div>
      </div>
    </form>
    
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
<script src="js/verifymail.js"></script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
      <div class="modal-body ajax_data"></div>
      <div class="modal-footer">
         <a href="#" class="btn" id="close">Close</a>
 </div> 
 </div>

