<?php 
require_once("inc/initialize.php");
$settings = new Settings(); 
if(!($settings->isApplicationOpen()))
{
	$session->logout();
	redirect_to('index.php');
}
 
if(!$session->is_logged_in())
{
	redirect_to('index.php');
}

$user = new User();

$user->applicant_id = $session->applicant_id;

$progress = $user->find_by_sql("SELECT progress FROM personal_details WHERE applicant_id='".$user->applicant_id."'");

$progress = array_shift($progress);

if($progress->progress=='Completed')
{
	redirect_to('confirmation.php');
}

$form_id = $user->get_form_id();

$sql = "SELECT * FROM `adm_access_code` WHERE `jamb_rem_no`='".$form_id."' AND `reg_num`='".$form_id."'";

$payment_record = $user->find_by_sql($sql);

if(empty($payment_record))
{
	redirect_to('select_form.php');
}

$student_status = $user->get_student_status();

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php 
	require_once(LIB_PATH.DS.'javascript.php');
	require_once(LIB_PATH.DS.'css.php');
?>
</head>
<body>
<?php include_layout_template("header.php"); ?> 
<?php include_layout_template("main_nav_login.php"); ?> 

<!--The Main Content Here Please-->

<!-- beginnning of main content-->
<div class="container">
	
		<div class="alert alert-info"><h4 style="text-align:center"><?php if($student_status == 'PGA') echo 'Postgraduate '; else echo 'Non-NUC '; ?>Application Form</h4></div>
		<form action="" class="complete_application_form" method="POST">
				<div align="center" class="control-group">
					  <div class="controls">  
						<input type="submit" class="btn btn-success" id="complete_application" name="complete_application" value="Complete Application" />
				      </div>
				</div>
			</form>
		<div class="border-radius" >
        <br>
			<!-- Beginning of tabs -->
			<div class="tabbable"> 
			  <!-- Beginning of tabs navigation -->
              <ul id="application_tabs" class="nav nav-tabs">
                <li class="active"><a href="#personal_details" >Personal Details</a></li>
				<li><a href="#academic_qualification" >Academic Qualification</a></li>
				<li><a href="#employment_details" >Employment Details</a></li>
				<?php
			    	if($student_status == 'PGA') {
			  	?>
					<li><a href="#proposed_topic_of_theis" >Proposed Topic of Thesis</a></li>
					<li><a href="#publications" >Publications</a></li>
					<li><a href="#referees" >Referees</a></li>
                    
				<?php
				    } else {
				?>
					<li><a href="#file_uploads" >Upload Files</a></li>
					<li><a href="#other_programme_details" >Other Programme Details</a></li>
				<?php
				    }
				?>
                <li><a href="#passport" >Upload Passport</a></li>
              </ul>
			  <!-- End of tabs navigation -->
			  
			  <!-- Beginning of Content -->
              <div class="tab-content">
                <div class="tab-pane active" id="personal_details">
                  <?php include_layout_template("personaldetails.php"); ?>
                </div>
                <div class="tab-pane" id="academic_qualification">
                  <?php include_layout_template("academic_qualification.php"); ?>
                </div>
				<div class="tab-pane" id="employment_details">
                   <?php include_layout_template("employment_details.php"); ?>
                </div>
                <?php
			    	if($student_status == 'PGA') {
			  	?>
					<div class="tab-pane" id="proposed_topic_of_theis">
	                <?php include_layout_template("proposed_topic_of_thesis_details.php"); ?>
	                </div>
					<div class="tab-pane" id="publications">
	                  <?php include_layout_template("publications.php"); ?>
	                </div>
					<div class="tab-pane" id="referees">
	                 <?php include_layout_template("referees_details.php"); ?>
	                </div>
	                <?php
	            	} else {
	               ?>
                    <div class="tab-pane" id="file_uploads">
	                 <?php include_layout_template("upload_files.php"); ?>
	                </div>
	            
	            	<div class="tab-pane" id="other_programme_details">
	                 <?php include_layout_template("other_programme_details.php"); ?>
	                </div>
	            <?php	
	            	}
	            ?>
                <div class="tab-pane" id="passport">
                 <?php include_layout_template("passport.php"); ?>
                </div>
               </div>
               <!-- End of tabs content -->
               
               <!-- Beginning of pagination -->
			    <div class="row-fluid">
				  <div class="span5 offset1">
					<div class="pagination">
					  <ul>
						<li><a id="prev" href="#">Prev</a></li>
					  </ul>
					</div>
				  </div>
				  <div class="span5">
					<div class="pagination pagination-right">
					  <ul>
						<li><a id="next" href="#">Next</a></li>
					  </ul>
					</div>
				  </div>
				</div>
				<!-- End of pagination -->
				
			  <!-- End of tabs -->
			</div>
			
		</div>
		
</div>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
      <div class="modal-body ajax_data"></div>
      <div class="modal-footer">
         <a href="#" class="btn" id="close">Close</a>
 </div> 
 </div>
<!--The Main Content Here Please-->
<?php include_layout_template("footer.php"); ?>
</body>
</html>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/dropdownscript.js"></script>
<script src="js/nav_tabs.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>