<?php
    if(isset($_GET[md5('id')])) {
	$referee_id = customDecrypt($_GET[md5('id')]);
	$database = new MySQLDatabase();
	
	$referee_details = $database->query("SELECT * FROM `referees`, `title` WHERE `referees`.`referees_id`='".$referee_id."' AND `referees`.`referee_title_id`=`title`.`title_id`");
	
	$referee_info = $database->fetch_array($referee_details);

	$applicant_details = User::find_by_id($referee_info['applicant_id']);
	$applicant_phone = $applicant_details->phone_number;
	$applicant_name = User::applicant_fullname($referee_info['applicant_id']);
?>
<h3 align="center">Referee Questionaire Form</h3>
<hr>


<h6 align="center">Applicant Details requesting your response </h6>
<div class="row-fluid">
	<div class="span11 offset1">
    	<form  action="#" method="POST" class="referee_form form-horizontal">
        <input type="hidden" value="<?php echo $referee_id; ?>" name="referee_id"/>
        	<!-- applicant name -->
            <div class="control-group">
				<label class="control-label" for="inputApplicantName">Name</label> 
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						<input type="text" readonly class="input-xlarge" name="applicant_name" id="applicant_name" value="<?php echo $applicant_name; ?>" />
					</div>
				</div>
			</div>
            
            <!-- applicant phone number -->
            <div class="control-group">
				<label class="control-label" for="inputPhoneNumber">Phone Number</label> 
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-hdd"></i></span>
						<input type="text" readonly class="input-xlarge" name="applicant_mobile" id="applicant_mobile" value="<?php echo $applicant_phone; ?>" />
					</div>
				</div>
			</div>
            
            <hr>
            
        	<!-- Referee Name -->
            <h6 align="center">All Fields are Required </h6>

			<div class="control-group">
				<label class="control-label" for="inputRefereeName">Referee Name</label> 
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						<input type="text" readonly class="input-xlarge" name="referee_name" id="referee_name" value="<?php echo $referee_info['title_name'].' '.$referee_info['referee_name']; ?>" />
					</div>
				</div>
			</div>
            <!-- professional rank of referee -->
            <div class="control-group">
				<label class="control-label" for="inputProfessionalRank">Professional Rank</label> 
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						<input type="text" class="input-xlarge" name="referee_rank" id="referee_rank" value="" />
					</div>
				</div>
			</div>
            
            <!-- Address -->
			<div class="control-group">
				<label class="control-label" for="inputAdress">Address</label> 
				<div class="controls">
					<div class="input-prepend">
			      		<span class="add-on"><i class="icon-home"></i></span>
						<textarea rows="4" class="input-xlarge" id="address" name="address"></textarea>
					</div>
				</div>
			</div>
            
            <!-- Job Description -->
            <div class="control-group">
				<label class="control-label" for="inputJobDescription">Job Description</label> 
				<div class="controls">
					<div class="input-prepend">
			      		<span class="add-on"><i class="icon-home"></i></span>
						<textarea rows="4" class="input-xlarge" id="job_description" name="job_description"></textarea>
					</div>
				</div>
			</div>
            
            <!-- How long have you known the candidate -->
            <div class="control-group">
				<label class="control-label" for="howLong">How long have you known the candidate</label> 
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-calendar"></i></span>
						<input type="text" class="input-xlarge" name="how_long" id="how_long" value="" />
					</div>
				</div>
			</div>
            
            <!-- in what capacity -->
            <div class="control-group">
				<label class="control-label" for="inputAdress">In What Capacity</label> 
				<div class="controls">
					<div class="input-prepend">
			      		<span class="add-on"><i class="icon-question-sign"></i></span>
						<textarea rows="4" class="input-xlarge" id="whatcapacity" name="whatcapacity"></textarea>
					</div>
				</div>
			</div>
            
            <!-- Comment on the candidate -->
            <div class="control-group">
				<label class="control-label" for="inputAdress">Comment on the candidate</label> 
				<div class="controls">
					<div class="input-prepend">
			      		<span class="add-on"><i class="icon-question-sign"></i></span>
						<textarea rows="4" class="input-xlarge" id="comment" name="comment"></textarea>
					</div>
				</div>
			</div>
            
            <!-- Rank a candidate -->
            <div class="control-group">
				<label class="control-label" for="howLong">Rank Candidate (/100%)</label> 
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-bookmark"></i></span>
						<input type="number" max="100" min="10" maxlength="2" class="input-xlarge" name="rank_candidate" id="rank_candidate" value="" />
					</div>
				</div>
			</div>
            <h4 align="center">Please fill the questionnaire below</h4>
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
                    <td><input type="radio" value="6" name="intellectual_capactiy"/></td>
                    <td><input type="radio" value="5" name="intellectual_capactiy"/></td>
                    <td><input type="radio" value="4" name="intellectual_capactiy"/></td>
                    <td><input type="radio" value="3" name="intellectual_capactiy"/></td>
                    <td><input type="radio" value="2" name="intellectual_capactiy"/></td>
                    <td><input type="radio" value="1" name="intellectual_capactiy"/></td>
                    <td><input type="radio" value="0" name="intellectual_capactiy"/></td>
                </tr>
                <tr>
                	<td>Capacity for persistent and independent academic study</td>
                    <td><input type="radio" value="6" name="capactiy_for_persistence"/></td>
                    <td><input type="radio" value="5" name="capactiy_for_persistence"/></td>
                    <td><input type="radio" value="4" name="capactiy_for_persistence"/></td>
                    <td><input type="radio" value="3" name="capactiy_for_persistence"/></td>
                    <td><input type="radio" value="2" name="capactiy_for_persistence"/></td>
                    <td><input type="radio" value="1" name="capactiy_for_persistence"/></td>
                    <td><input type="radio" value="0" name="capactiy_for_persistence"/></td>
                </tr>
                <tr>
                	<td>Ability for imaginative thought</td>
                    <td><input type="radio" value="6" name="ability_for_imagination"/></td>
                    <td><input type="radio" value="5" name="ability_for_imagination"/></td>
                    <td><input type="radio" value="4" name="ability_for_imagination"/></td>
                    <td><input type="radio" value="3" name="ability_for_imagination"/></td>
                    <td><input type="radio" value="2" name="ability_for_imagination"/></td>
                    <td><input type="radio" value="1" name="ability_for_imagination"/></td>
                    <td><input type="radio" value="0" name="ability_for_imagination"/></td>
                </tr>
                <tr>
               		<td>Promise of productive scholarship</td>
                    <td><input type="radio" value="6" name="promise_of_productive_scholarship"/></td>
                    <td><input type="radio" value="5" name="promise_of_productive_scholarship"/></td>
                    <td><input type="radio" value="4" name="promise_of_productive_scholarship"/></td>
                    <td><input type="radio" value="3" name="promise_of_productive_scholarship"/></td>
                    <td><input type="radio" value="2" name="promise_of_productive_scholarship"/></td>
                    <td><input type="radio" value="1" name="promise_of_productive_scholarship"/></td>
                    <td><input type="radio" value="0" name="promise_of_productive_scholarship"/></td>
                </tr>
                <tr>
                	<td>Quality of previous work</td>
                    <td><input type="radio" value="6" name="quality_of_previous_work"/></td>
                    <td><input type="radio" value="5" name="quality_of_previous_work"/></td>
                    <td><input type="radio" value="4" name="quality_of_previous_work"/></td>
                    <td><input type="radio" value="3" name="quality_of_previous_work"/></td>
                    <td><input type="radio" value="2" name="quality_of_previous_work"/></td>
                    <td><input type="radio" value="1" name="quality_of_previous_work"/></td>
                    <td><input type="radio" value="0" name="quality_of_previous_work"/></td>
                </tr>
                <tr>
                	<td>Oral and written expressions in English Language</td>
                    <td><input type="radio" value="6" name="oral_written_expressions"/></td>
                    <td><input type="radio" value="5" name="oral_written_expressions"/></td>
                    <td><input type="radio" value="4" name="oral_written_expressions"/></td>
                    <td><input type="radio" value="3" name="oral_written_expressions"/></td>
                    <td><input type="radio" value="2" name="oral_written_expressions"/></td>
                    <td><input type="radio" value="1" name="oral_written_expressions"/></td>
                    <td><input type="radio" value="0" name="oral_written_expressions"/></td>
                </tr>
            </table>
            
            <div id="accept_terms">     
                <div class="control-group">
                      <div class="controls">  
                        <button type="submit" class="btn btn-primary" id="referee_form_submit">Save</button>
                        <button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
                      </div>
                </div>
            </div>
            
        </form>
    </div>
</div>
<?php
    } 
    else
    {
        echo '<h3>404 - Please go through your email!</h3>';
    }
?>