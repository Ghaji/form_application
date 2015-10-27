<?php require_once("../inc/initialize.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php require_once(LIB_PATH.DS.'css.php'); ?>

</head>
<body>

	<!-- header -->
	<?php
		include_layout_template('admin_header.php');
	?>
	<!-- //header -->
		
	<div class="row-fluid">
		
		<?php
				include_layout_template('admin_menu.php');
			?>
			
		<div class="span9 create" >
        
			<?php
				if(isset($_POST["refid"])) {
					$referee_id = customDecrypt($_POST["refid"]);
					$applicant_id = customDecrypt($_POST["aid"]);
					
					$database = new MySQLDatabase();
					
					$referee_details = $database->query("SELECT * FROM `referees`, `title` WHERE `referees`.`referees_id`='".$referee_id."' AND `referees`.`referee_title_id`=`title`.`title_id`");
					
					$referee_info = $database->fetch_array($referee_details);
				
					$applicant_details = User::find_by_id($referee_info['applicant_id']);
					$applicant_form_id = $applicant_details->form_id;
					$applicant_name = User::applicant_fullname($referee_info['applicant_id']);
					
					$questionnaire = unserialize($referee_info['questionnaire']);
					
					function check_IC($i) {
						global $questionnaire;
						if($i == $questionnaire["intellectual_capactiy"]){
							echo "checked";
						}
					}
					
					function check_CFP($i) {
						global $questionnaire;
						if($i == $questionnaire["capactiy_for_persistence"]){
							echo "checked";
						}
					}
					
					function check_AFI($i) {
						global $questionnaire;
						if($i == $questionnaire["ability_for_imagination"]){
							echo "checked";
						}
					}
					
					function check_POPS($i) {
						global $questionnaire;
						if($i == $questionnaire["promise_of_productive_scholarship"]){
							echo "checked";
						}
					}
					
					function check_QOPW($i) {
						global $questionnaire;
						if($i == $questionnaire["quality_of_previous_work"]){
							echo "checked";
						}
					}
					
					function check_OWE($i) {
						global $questionnaire;
						if($i == $questionnaire["oral_written_expressions"]){
							echo "checked";
						}
					}
				}
			?>
			<h3 align="center">Referee Response</h3>
			<hr>
			<div class="row-fluid">
				<div class="span11 offset1">
			    	<form  action="applicant_details.php" method="POST" class="referee_form">
			    		<h4>Applicant's Details</h4>
			    		<!-- Applicantion Number (Form ID) -->
			            <div class="control-group">
							<label class="control-label" for="inputApplicationNumber">Application Number</label> 
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-hdd"></i></span>
									<input type="text" readonly="readonly" class="input-xlarge" name="applicant_form_id" id="applicant_form_id" value="<?php if(isset($applicant_form_id)) echo $applicant_form_id; ?>" />
								</div>
							</div>
						</div>
			    		
			        	<!-- applicant name -->
			            <div class="control-group">
							<label class="control-label" for="inputApplicantName">Name</label> 
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-user"></i></span>
									<input type="text" readonly="readonly" class="input-xlarge" name="applicant_name" id="applicant_name" value="<?php if(isset($applicant_name)) echo $applicant_name; ?>" />
								</div>
							</div>
						</div>
			            
			            <hr >
			            
			            <h4>Referee's Details</h4>
						<div class="control-group">
							<label class="control-label" for="inputRefereeName">Referee Name</label> 
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-user"></i></span>
									<input type="text" readonly="readonly" class="input-xlarge" name="referee_name" id="referee_name" value="<?php if(isset($referee_info['referee_name'])) echo $referee_info['title_name'].' '.$referee_info['referee_name']; ?>" />
								</div>
							</div>
						</div>
			            <!-- professional rank of referee -->
			            <div class="control-group">
							<label class="control-label" for="inputProfessionalRank">Professional Rank</label> 
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-user"></i></span>
									<input type="text" readonly="readonly" class="input-xlarge" name="referee_rank" id="referee_rank" value="<?php if(isset($referee_info["referee_highest_qualification_obtained"])) echo $referee_info["referee_highest_qualification_obtained"]; ?>" />
								</div>
							</div>
						</div>
			            
			            <!-- Address -->
						<div class="control-group">
							<label class="control-label" for="inputAdress">Address</label> 
							<div class="controls">
								<div class="input-prepend">
						      		<span class="add-on"><i class="icon-home"></i></span>
									<textarea rows="4" readonly="readonly" class="input-xlarge" id="address" name="address"><?php if(isset($referee_info["referee_address"])) echo $referee_info["referee_address"]; ?></textarea>
								</div>
							</div>
						</div>
			            
			            <!-- Job Description -->
			            <div class="control-group">
							<label class="control-label" for="inputJobDescription">Job Description</label> 
							<div class="controls">
								<div class="input-prepend">
						      		<span class="add-on"><i class="icon-home"></i></span>
									<textarea rows="4" readonly="readonly" class="input-xlarge" id="job_description" name="job_description"><?php if(isset($referee_info["referee_job_description"])) echo $referee_info["referee_job_description"]; ?></textarea>
								</div>
							</div>
						</div>
			            
			            <!-- How long have you known the candidate -->
			            <div class="control-group">
							<label class="control-label" for="howLong">How long have you known the candidate</label> 
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-calendar"></i></span>
									<input type="text" readonly="readonly" class="input-xlarge" name="how_long" id="how_long" value="<?php if(isset($referee_info["how_long"])) echo $referee_info["how_long"]; ?>" />
								</div>
							</div>
						</div>
			            
			            <!-- in what capacity -->
			            <div class="control-group">
							<label class="control-label" for="inputAdress">In What Capacity</label> 
							<div class="controls">
								<div class="input-prepend">
						      		<span class="add-on"><i class="icon-question-sign"></i></span>
									<textarea rows="4" readonly="readonly" class="input-xlarge" id="whatcapacity" name="whatcapacity"><?php if(isset($referee_info["what_capacity"])) echo $referee_info["what_capacity"]; ?></textarea>
								</div>
							</div>
						</div>
			            
			            <!-- Comment on the candidate -->
			            <div class="control-group">
							<label class="control-label" for="inputAdress">Comment on the candidate</label> 
							<div class="controls">
								<div class="input-prepend">
						      		<span class="add-on"><i class="icon-question-sign"></i></span>
									<textarea rows="4" readonly="readonly" class="input-xlarge" id="comment" name="comment"><?php if(isset($referee_info["comments_on_candidate"])) echo $referee_info["comments_on_candidate"]; ?></textarea>
								</div>
							</div>
						</div>
			            
			            <!-- Rank a candidate -->
			            <div class="control-group">
							<label class="control-label" for="howLong">Rank Candidate (/100%)</label> 
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on"><i class="icon-bookmark"></i></span>
									<input type="text" readonly="readonly" class="input-xlarge" name="rank_candidate" id="rank_candidate" value="<?php if(isset($referee_info["rank_candidate"])) echo $referee_info["rank_candidate"]; ?>" />
								</div>
							</div>
						</div>
			            <h4 align="center">Questionnaire Answer</h4>
			            <table class="table table-bordered" align="center">
			            	<tr>
			                	<th></th>
			                    <th>Excellent</th>
			                    <th>Very Good</th>
			                    <th>Good</th>
			                    <th>Slightly Above Average</th>
			                    <th>Average</th>
			                    <th>Below Average</th>
			                    <th>Can't Assess</th>
			                </tr>
			                <tr>
			                	<td>Intellectual Capacity</td>
			                    <td><input disabled type="radio" value="6" <?php check_IC(6); ?> name="intellectual_capactiy"/></td>
			                    <td><input disabled type="radio" value="5" <?php check_IC(5); ?> name="intellectual_capactiy"/></td>
			                    <td><input disabled type="radio" value="4" <?php check_IC(4); ?> name="intellectual_capactiy"/></td>
			                    <td><input disabled type="radio" value="3" <?php check_IC(3); ?> name="intellectual_capactiy"/></td>
			                    <td><input disabled type="radio" value="2" <?php check_IC(2); ?> name="intellectual_capactiy"/></td>
			                    <td><input disabled type="radio" value="1" <?php check_IC(1); ?> name="intellectual_capactiy"/></td>
			                    <td><input disabled type="radio" value="0" <?php check_IC(0); ?> name="intellectual_capactiy"/></td>
			                </tr>
			                <tr>
			                	<td>Capacity for persistent and independent academic study</td>
			                    <td><input disabled type="radio" value="6" <?php check_CFP(6); ?> name="capactiy_for_persistence"/></td>
			                    <td><input disabled type="radio" value="5" <?php check_CFP(5); ?>  name="capactiy_for_persistence"/></td>
			                    <td><input disabled type="radio" value="4" <?php check_CFP(4); ?>  name="capactiy_for_persistence"/></td>
			                    <td><input disabled type="radio" value="3" <?php check_CFP(3); ?>  name="capactiy_for_persistence"/></td>
			                    <td><input disabled type="radio" value="2" <?php check_CFP(2); ?>  name="capactiy_for_persistence"/></td>
			                    <td><input disabled type="radio" value="1" <?php check_CFP(1); ?>  name="capactiy_for_persistence"/></td>
			                    <td><input disabled type="radio" value="0" <?php check_CFP(0); ?>  name="capactiy_for_persistence"/></td>
			                </tr>
			                <tr>
			                	<td>Ability for imaginative thought</td>
			                    <td><input disabled type="radio" value="6" <?php check_AFI(6); ?> name="ability_for_imagination"/></td>
			                    <td><input disabled type="radio" value="5" <?php check_AFI(5); ?> name="ability_for_imagination"/></td>
			                    <td><input disabled type="radio" value="4" <?php check_AFI(4); ?> name="ability_for_imagination"/></td>
			                    <td><input disabled type="radio" value="3" <?php check_AFI(3); ?> name="ability_for_imagination"/></td>
			                    <td><input disabled type="radio" value="2" <?php check_AFI(2); ?> name="ability_for_imagination"/></td>
			                    <td><input disabled type="radio" value="1" <?php check_AFI(1); ?> name="ability_for_imagination"/></td>
			                    <td><input disabled type="radio" value="0" <?php check_AFI(0); ?> name="ability_for_imagination"/></td>
			                </tr>
			                <tr>
			               		<td>Promise of productive scholarship</td>
			                    <td><input disabled type="radio" value="6" <?php check_POPS(6); ?> name="promise_of_productive_scholarship"/></td>
			                    <td><input disabled type="radio" value="5" <?php check_POPS(5); ?>  name="promise_of_productive_scholarship"/></td>
			                    <td><input disabled type="radio" value="4" <?php check_POPS(4); ?>  name="promise_of_productive_scholarship"/></td>
			                    <td><input disabled type="radio" value="3" <?php check_POPS(3); ?>  name="promise_of_productive_scholarship"/></td>
			                    <td><input disabled type="radio" value="2" <?php check_POPS(2); ?>  name="promise_of_productive_scholarship"/></td>
			                    <td><input disabled type="radio" value="1" <?php check_POPS(1); ?>  name="promise_of_productive_scholarship"/></td>
			                    <td><input disabled type="radio" value="0" <?php check_POPS(0); ?>  name="promise_of_productive_scholarship"/></td>
			                </tr>
			                <tr>
			                	<td>Quality of previous work</td>
			                    <td><input disabled type="radio" value="6"  <?php check_QOPW(6); ?> name="quality_of_previous_work"/></td>
			                    <td><input disabled type="radio" value="5"  <?php check_QOPW(5); ?>  name="quality_of_previous_work"/></td>
			                    <td><input disabled type="radio" value="4"  <?php check_QOPW(4); ?>  name="quality_of_previous_work"/></td>
			                    <td><input disabled type="radio" value="3"  <?php check_QOPW(3); ?>  name="quality_of_previous_work"/></td>
			                    <td><input disabled type="radio" value="2"  <?php check_QOPW(2); ?>  name="quality_of_previous_work"/></td>
			                    <td><input disabled type="radio" value="1"  <?php check_QOPW(1); ?>  name="quality_of_previous_work"/></td>
			                    <td><input disabled type="radio" value="0"  <?php check_QOPW(0); ?>  name="quality_of_previous_work"/></td>
			                </tr>
			                <tr>
			                	<td>Oral and written expressions in English Language</td>
			                    <td><input disabled type="radio" value="6"  <?php check_OWE(6); ?> name="oral_written_expressions"/></td>
			                    <td><input disabled type="radio" value="5"  <?php check_OWE(5); ?> name="oral_written_expressions"/></td>
			                    <td><input disabled type="radio" value="4"  <?php check_OWE(4); ?> name="oral_written_expressions"/></td>
			                    <td><input disabled type="radio" value="3"  <?php check_OWE(3); ?> name="oral_written_expressions"/></td>
			                    <td><input disabled type="radio" value="2"  <?php check_OWE(2); ?> name="oral_written_expressions"/></td>
			                    <td><input disabled type="radio" value="1"  <?php check_OWE(1); ?> name="oral_written_expressions"/></td>
			                    <td><input disabled type="radio" value="0"  <?php check_OWE(0); ?> name="oral_written_expressions"/></td>
			                </tr>
			            </table>
			            	<button type="submit" class="btn btn-default" name="view_applicant">Back to Applicant Details</button>
							<input type="hidden" name="applicant_id" value="<?php echo customEncrypt($applicant_id); ?>" />
			        </form>
			    </div>
			</div>
	
		</div>
		
		<!-- <div class="span4">		
			<div class="create" >
				<h5 align="center">How to Create an Account</h5>
				<hr>
                <p class="pad">
                Use the Guide-line below to Create an account and also pay for the form online using the our payment gate-way, below is how.</p>
                <ul><li><span class="label label-success">Create and account and make payment</span></li></ul>
                <ol>
                <li>Create an Account if you don't already have.</li>
                <li>After which you will select your programme and </li>
                <li>A form number will be created for you automatically </li>
                <li>Proceed to the payment engine and enter your card details</li>
                <li>Then print your reciept and  </li>
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
		</div> -->
	</div>

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