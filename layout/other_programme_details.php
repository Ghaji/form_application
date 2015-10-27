<?php 
	$session = new Session();
	
	$ArrayOtherProgrammeDetails = OtherProgramme::find_by_id($session->applicant_id);
	
?>
<h3 align="center">Other Programme Details</h3>
<hr>
<h6 align="center">All Fields are Required </h6>
<div class="row-fluid">
	<div class="span6 offset3">

		<form action="" method="POST" class="other_programme_details form-horizontal" >
		
		<h5>Sponsor and Guidance Details</h5>
			<hr>
			<!-- Fullname -->
			<div class="control-group">
				<label class="control-label" for="inputFullName">Fullname</label> 
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						<input type="text" class="input-xlarge" value="<?php if(isset($ArrayOtherProgrammeDetails->sponsor_fullname)) echo $ArrayOtherProgrammeDetails->sponsor_fullname; ?>" name="fullname_id" id="fullname_id" />
					</div>
				</div>
			</div>
			

		  
		    <!--Occupation -->
			<div class="control-group">
				<label class="control-label" for="inputOccupation">Occupation</label> 
				<div class="controls">
					<div class="input-prepend">
                    <span class="add-on"><i class="iconic-box"></i></span>
						<input type="text" class="input-xlarge" value="<?php if(isset($ArrayOtherProgrammeDetails->sponsor_occupation)) echo $ArrayOtherProgrammeDetails->sponsor_occupation; ?>" name="occupation" id="occupation" />
					</div>
				</div>
			</div>
			<!--Mailing Address-->
			<div class="control-group">
			<label class="control-label" for="inputMailingAddress">Address</label> 
				<div class="controls">
					<div class="input-prepend">
                    <span class="add-on"><i class="iconic-pen-alt2"></i></span>
					<textarea rows="4" class="input-xlarge" id="address" name="address"><?php if(isset($ArrayOtherProgrammeDetails->sponsor_address)) echo $ArrayOtherProgrammeDetails->sponsor_address; ?></textarea>
					</div>
				</div>
			</div>			
		  <!--Have you Applied to Any Other Institution-->
		  <div class="control-group">
		    <label class="radio inline">Have you Applied To Any Other institution &nbsp;&nbsp;&nbsp;</label>
            <?php
				if(isset($ArrayOtherProgrammeDetails->applied_to_other_institution) && $ArrayOtherProgrammeDetails->applied_to_other_institution == 1)
				{
				echo '	<label class="radio inline">
					<input type="radio" name="applied_to_other_institution" id="applied_to_other_institution_yes" value="1" checked="checked">Yes
					</label>
					<label class="radio inline">
					<input type="radio" name="applied_to_other_institution" id="applied_to_other_institution" value="0">No
					</label>';
					
				}
				elseif(isset($ArrayOtherProgrammeDetails->applied_to_other_institution) && $ArrayOtherProgrammeDetails->applied_to_other_institution == 0)
				{
					echo '	<label class="radio inline">
					<input type="radio" name="applied_to_other_institution" id="applied_to_other_institution_yes" value="1">Yes
					</label>
					<label class="radio inline">
					<input type="radio" name="applied_to_other_institution" id="applied_to_other_institution" value="0" checked="checked">No
					</label>';
				}
				else
				{
					echo '	<label class="radio inline">
					<input type="radio" name="applied_to_other_institution" id="applied_to_other_institution_yes" value="1">Yes
					</label>
					<label class="radio inline">
					<input type="radio" name="applied_to_other_institution" id="applied_to_other_institution" value="0">No
					</label>';
				}
			?>
		  </div>
          
          <!-- a div wrapping all the fields that depends on the possibility that the applicant has applied to another school-->
          
		<div class="other_university_details" style="display:none;">
		  <!--Were You Denied Admission-->
		  <div class="control-group">
		    <label class="radio inline">Were You Denied Admission &nbsp;&nbsp;&nbsp;</label>
            <?php
				if(isset($ArrayOtherProgrammeDetails->denied_admission) && $ArrayOtherProgrammeDetails->denied_admission == 1)
				{
				echo '	<label class="radio inline">
					<input type="radio" name="denied_admission" id="denied_admission" value="1" checked="checked">Yes
					</label>
					<label class="radio inline">
					<input type="radio" name="denied_admission" id="denied_admission" value="0">No
					</label>';
				}
				elseif(isset($ArrayOtherProgrammeDetails->denied_admission) && $ArrayOtherProgrammeDetails->denied_admission == 0 && $ArrayOtherProgrammeDetails->denied_admission != '')
				{
					echo '	<label class="radio inline">
					<input type="radio" name="denied_admission" id="denied_admission" value="1">Yes
					</label>
					<label class="radio inline">
					<input type="radio" name="denied_admission" id="denied_admission" value="0" checked="checked">No
					</label>';
				}
				else
				{
					echo '	<label class="radio inline">
					<input type="radio" name="denied_admission" id="denied_admission" value="1">Yes
					</label>
					<label class="radio inline">
					<input type="radio" name="denied_admission" id="denied_admission" value="0">No
					</label>';
				}
			?>
            
		  </div>
		  	<h5>If Answer to Either Question is Yes, please Give Name And address and other Details</h5>
			<hr>
			<!--Name and Address and other Details -->
			<div class="control-group">
				<label class="control-label" for="inputName">Name of Institution</label> 
				<div class="controls">
                
					<div class="input-prepend">
                    <span class="add-on"><i class="icon-user"></i></span>
						<input type="text" class="input-xlarge" value="<?php if(isset($ArrayOtherProgrammeDetails->institution_name)) echo $ArrayOtherProgrammeDetails->institution_name; ?>" name="institution_name" id="institution_name" />
					</div>
				</div>
			</div>
            <!--Transfer From Other institution Address-->
			<div class="control-group">
			<label class="control-label" for="inputAddress">Address Of institution</label> 
				<div class="controls">
					<div class="input-prepend">
                    <span class="add-on"><i class="iconic-pen-alt2"></i></span>
					<textarea rows="4" class="input-xlarge" id="institution_address" name="institution_address"><?php if(isset($ArrayOtherProgrammeDetails->institution_address)) echo $ArrayOtherProgrammeDetails->institution_address; ?></textarea>
					</div>
				</div>
			</div>
			<!--Other Details-->
			<div class="control-group">
			<label class="control-label" for="inputOtherDetails">Other Details</label> 
				<div class="controls">
					<div class="input-prepend">
                    <span class="add-on"><i class="iconic-pen-alt2"></i></span>
					<textarea rows="4" class="input-xlarge" id="other_details" name="other_details"><?php if(isset($ArrayOtherProgrammeDetails->other_details)) echo $ArrayOtherProgrammeDetails->other_details; ?></textarea>
					</div>
				</div>
			</div>
        
			<h5>If You Are transferring From or Have Been to other Institution Please State</h5>
			<hr>
			<!--Name and Address Of Institution Transfer from or Been To -->
			<div class="control-group">
				<label class="control-label" for="inputNameOfInstitution">Name of Institution</label> 
				<div class="controls">
					<div class="input-prepend">
                    <span class="add-on"><i class="icon-user"></i></span>
						<input type="text" class="input-xlarge" value="<?php if(isset($ArrayOtherProgrammeDetails->name_of_institution)) echo $ArrayOtherProgrammeDetails->name_of_institution; ?>" name="name_of_institution" id="name_of_institution" />
					</div>
				</div>
			</div>
            
            
            <!--Address of Transfer From other Institution-->
			<div class="control-group">
				<label class="control-label" for="inputAddressOfInstitution">Address Of Institution</label> 
				<div class="controls">
					<div class="input-prepend">
                    <span class="add-on"><i class="iconic-pen-alt2"></i></span>
					<textarea rows="4" class="input-xlarge" id="address_of_institution" name="address_of_institution"><?php if(isset($ArrayOtherProgrammeDetails->address_of_institution)) echo $ArrayOtherProgrammeDetails->address_of_institution; ?></textarea>
					</div>
				</div>
			</div>
						<!-- Date of Admission here -->
			<div class="control-group">
			    <label class="control-label" for="inputDateOfAdmission">Date of Admission</label>
			    <div class="controls">
				    <div class="input-prepend">
					<span class="add-on"><i class="icon-calendar"></i></span>
	                    <input type="text" class="input-medium datepicker" value="<?php if(isset($ArrayOtherProgrammeDetails->date_of_admission)) echo $ArrayOtherProgrammeDetails->date_of_admission; ?>" id="date_of_adm" name="date_of_adm" maxlength="10"  data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD"  />
					</div>
				</div>
			</div>
						<!--Present Course of Study -->
			<div class="control-group">
				<label class="control-label" for="inputFullName">Present Course of Study</label> 
				<div class="controls">
					<div class="input-prepend">
                    <span class="add-on"><i class="icon-user"></i></span>
						<input type="text" class="input-xlarge" value="<?php if(isset($ArrayOtherProgrammeDetails->course_of_study)) echo $ArrayOtherProgrammeDetails->course_of_study; ?>" name="Present_Course_of_Study" id="Present_Course_of_Study" />
					</div>
				</div>
			</div>
        </div>
        <!-- end of the toggling div -->
        
			<!--Reasons for Seeking Admission To This Programme-->
			<div class="control-group">
            	<label class="control-label" for="inputReason">Reasons for Seeking Admission To This Programme</label> 
				<div class="controls">
					<div class="input-prepend">
                    <span class="add-on"><i class="iconic-pen-alt2"></i></span>
					<textarea rows="4" class="input-xlarge" id="reasons_for_seeking_admission" name="reasons_for_seeking_admission"><?php if(isset($ArrayOtherProgrammeDetails->reasons)) echo $ArrayOtherProgrammeDetails->reasons; ?></textarea>
					</div>
				</div>
			</div>

			<!--Save and Continue Button-->
			<div id="accept_terms">		
				<div class="control-group">
					  <div class="controls">  
						<button type="submit" class="btn btn-primary" id="other_programme_submit">Save</button>
						<button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
				      </div>
				</div>
			</div>
		<!-- End of Save and Continue Button-->
		</form>
		<!-- End of form -->
	</div>
</div>