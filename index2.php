<?php require_once("inc/initialize.php");
	//checks if user is logged in 
	$session->logout();
	
	$settings = new Settings();
	
	if($session->is_logged_in())
	{
		redirect_to('application_form.php');
	}
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
<!-- beginnning of main content-->
<div class="container">
	<div class="row-fluid">
		<div class="span7" >
		<h4>Welcome to University of Jos Online Form Portal</h4>
        <hr>

      	<h3><i class="icon-bullhorn"></i> NEWS</h3>
        <!-- # New Content Here -->

          <?php include_layout_template('news_details.php'); ?>

        <!-- # End of News Content -->
      
        		<h3><i class="icon-certificate"></i> Admission Requirements</h3>
           <?php 
    
              include_layout_template("requrement_details.php");

           ?>
        	
      
	       <!-- <form action="tsaro/load.php" method="POST" target="_blank">
				<button type="submit" class="btn btn-default view-file">Print Admission Requirement</button>
				<input type="hidden" name="aid" value="documents/Postgraduate_Programmes_and_Eligibility.pdf" />
			</form> -->
<!-- <a href="documents/Postgraduate_Programmes_and_Eligibility.pdf" target="_blank" class="btn"><i class="icon-print"></i> Print Eligibility Document</a> -->
		</div>
		<div class="span5">
        
        <div class="create" >
				
				<?php
					include_layout_template("login.php");
				?>
				
			</div>
			<div class="create">
				
                <h5 align="center">Start Application</h5>
                <hr>
				<p class="pad">If you are a new applicant, you need to first create an account to obtain a <span style="color: #090; font-weight: bold; text-shadow: 1px 1px 4px #00CCCC"><i class="iconic-o-check" style="color: #51A351"></i> Form Number</span> which you will use to pay for your application online.</p>
                <?php
					if($settings->isApplicationOpen())
					$status = true;
					else $status=false;
				?>
                    <form class="form-horizontal" action="register.php" >
                      
                        <div class="control-group">
                        <label class="control-label" ></label>
                        <div class="controls">
                        <?php
							if($status)
							echo '<button type="submit" class="btn btn-primary">Create Account</button>';
							else
							echo '<button type="submit" disabled="disabled" class="btn btn-danger">Create Account</button>';
							
						?>
                          
                        </div>
                      </div>
                    </form>
				<hr>
                <?php
					if(!$status)
					{
						echo '<h5 align="center"><p><span style="color: #F00; font-weight: bold; text-shadow: 1px 1px 4px #F89406"><i class="iconic-o-x"></i> Application Close</span></p></h5>';
					}
					else
					{
						echo '<h5 align="center"><p><span style="color: green; font-weight: bold; text-shadow: 1px 1px 4px #F89406"><i class="iconic-o-check"></i> Application Currently on</span></p></h5>';
						echo $settings->getApplicationCloseDate();
					}
				?>
               
			</div>
		
			
		</div>
	</div>
</div>
<hr>
<?php include_layout_template("footer.php"); ?>

  

</body>
</html>

<?php require_once(LIB_PATH.DS.'javascript.php'); ?>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/log.js"></script>
 