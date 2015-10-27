<?php require_once("inc/initialize.php");
	//print_r($session->applicant_id);
$settings = new Settings();
if(!($settings->isApplicationOpen()))
{
	$session->logout();
	redirect_to('index.php');
}

	if(!$session->is_logged_in()){
		
		redirect_to('index.php');
	}
	//gets applicant id
	$applicant_form_id = User::find_by_sql("SELECT `form_id` FROM `personal_details` WHERE `applicant_id`='".$session->applicant_id."'");
	//print_r($applicant_form_id);
	foreach($applicant_form_id as $applicantFormId)
	{
		$applicantFormId->form_id;
	}
	//if there is a form id then the applicant should proceed to form
	if($applicantFormId->form_id != NULL)
	{
		//echo "YEs";
		redirect_to('payment.php');
	}
	else
	{
		//echo "no";
		// set applicant_id into the session 
		$applicant_id = $session->applicant_id;
		$applicant_fullname = User::applicant_fullname($applicant_id);
	}
	
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php 
	require_once(LIB_PATH.DS.'css.php');
?>
</head>
<body>
<?php include_layout_template("header.php");

?>
<!--The Main Content Here Please-->

<!-- beginnning of main content-->
<div class="container">
	<div class="row-fluid">
		<div class="span7" >
			<div class="create">
				<h5 align="center">Please continue application</h5>
				
				<form class="form-horizontal select_programme">
					<div class="control-group">
						 <label class="control-label" for="inputName">Fullname</label> 
	    					<div class="controls">
	    						 <div class="input-prepend">
						      		<span class="add-on"><i class="icon-user"></i></span>
<input type="text" readonly class="input-xlarge" value="<?php if (isset($applicant_fullname))echo $applicant_fullname; ?>" name="full_name" id="full_name" />
						    	 </div>
	    					</div>
	  				</div>
     <?php 
	  $sql_faculty = "SELECT * FROM faculty WHERE `status` = 1 ORDER BY faculty_name ASC";
	  $result_set = $database->query($sql_faculty);
	?>
		
	 <div class="control-group">
	    <label class="control-label">Programme</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-chevron-down"></i></span>
                    <select class="input-xlarge" name="faculty_id" id="faculty_id" onChange="get_options(this.value);" >
                    <option value="">--Select Programme--</option>
                    <?php
						while($row = $database->fetch_array($result_set))
						{
							echo '<option value="'. $row['faculty_id'] .'">'.$row['faculty_name'].'</option>'; 
	 					}
					?>
                    </select>
				</div>
			</div>
	</div>
    
	<div class="control-group">
	    <label class="control-label">Course</label>
		<div class="controls">
		    <div class="input-prepend">
			<span class="add-on"><i class="icon-chevron-down"></i></span>	
	       	<select class="input-xlarge" name="department_id" id="department_id" >
	        	<option value="">--Select Course--</option>
	         	<div id="department_id"> </div>
	        </select>
			</div>
		</div>
	</div>
    <!--type of programm-->
		  <div class="control-group">
			    <label class="control-label" for="inputFulTime">Type of Programme</label>
				<div class="controls">
                	<div class="input-prepend">
						<span class="add-on"><i class="icon-chevron-down"></i></span>
                        <select class="input-large" name="type_of_programme" id="type_of_programme" >
                            <option value="">--Part/Full Time--</option>
                            <option value="FT">Full-Time</option>
                            <option value="PT">Part-Time</option>
                        </select>
                	</div>
				</div>
			</div>
            
            
					<!-- beginning for submit -->
					<div id="accept_terms">		
						<div class="control-group">
						  <div class="controls">  
							<button type="submit" class="btn btn-primary" id="submit" >Submit</button>
							<button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
					      </div>	
						</div>
					</div>
					<!-- end for submit -->
				</form>
				<!-- End of select application form -->
			</div>
		</div>
		<!-- Beginning of NOTE to appicant -->
		<div class="span5">
			<div class="create">
	            <h5 align="center">Note:</h5>
	            <hr>
				<p class="pad">
                	Take note of the following before you select a course
                	<ul>
                    	<li>Ensure that you pick the right programme and course</li>
                        <li>After selecting a course, a confirmation pop up</li>
                        <li>You can click on continue if the information displayed on the confirmation is what you want</li>
                        <li>You cannot afford to make mistakes because you cannot change your course once you confirm you selections</li>
                        <li>After confirming the information, you will be redirected to the payment engine where you pay for the form</li>
                        <br>
                    </ul>
                </p>
	            
			</div>			
		</div>
		<!-- End of NOTE to appicant -->
	</div>
</div>
<!--The Main Content Here Please-->
<?php include_layout_template("footer.php"); ?>
</body>
</html>
<?php //require_once(LIB_PATH.DS.'javascript.php'); ?>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/select_form.js"></script>
<script src="selector.js"></script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
      <div class="modal-body ajax_data"></div>
      <div class="modal-footer">
         <a href="#" class="btn" id="close">Close</a>
 </div> 
 </div>