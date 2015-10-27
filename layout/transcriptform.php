
<h6 align="center">All Fields are Required</h6>

<form action="" method="POST" class="create_form form-horizontal" >

  <div class="control-group">
    <label class="control-label" for="inputFulname">Fullname</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="Fullname" name="fullname" placeholder="Enter Fullname" required />
    	</div>
    </div>
  </div>

<!--Programme Intended-->
			<div class="control-group">
			    <label class="control-label" for="inputProgrammeIntended">Programme intended</label>
					<div class="controls">
					    <div class="input-prepend">
						<span class="add-on"><i class="icon-chevron-down"></i></span>
		                    <select>
		                    	<option value="">--Select Programme--</option>
		                    </select>
						</div>
					</div>
			</div>
            
      <!-- Date of birth here -->
			<div class="control-group">
			    <label class="control-label" for="inputDateOfBirth">Date of Birth</label>
			    <div class="controls">
				    <div class="input-prepend">
					<span class="add-on"><i class="icon-calendar"></i></span>
	                    <input type="text" class="input-medium datepicker" value="" id="dob" name="dob" maxlength="10"  data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" />
					</div>
				</div>
			</div>
           
  <div class="control-group">
    <label class="control-label" for="inputaccountnumber">LSAC account number</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-chevron-down"></i></span>
            <input type="text" id="LSAC account number" name="LSAC account number" placeholder="Enter account number" required />
    	</div>
    </div>
  </div>
 
  <hr> <p align="justify">POST SECONDARY INTITUTION: The person whose name appears above is applying to one LLM programe Please complete thie information below and return this form along with the applicant’s official informatio below may be used in the event we have contact you regarding the applicant’s academic record. Please include this form with the academic record ypou are sending</p>
          
    <hr>
 
   <div class="control-group">
    <label class="control-label" for="inputFulname">Number of Institutions</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-chevron-down"></i></span>
            <input type="text" id="Number of Institutions" name="Number of Institutions" placeholder="" required />
    	</div>
    </div>
  </div>
  
   <!-- Date of Attendance -->
			<div class="control-group">
			    <label class="control-label" for="inputDateOfAttendance">Date of Attendance</label>
			    <div class="controls">
				    <div class="input-prepend">
					<span class="add-on"><i class="icon-calendar"></i></span>
	                    <input type="text" class="input-medium datepicker" value="" id="dob" name="dob" maxlength="10"  data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" />
                 	</div>
   				 </div>
  			</div>
            
     <div class="control-group">
    <label class="control-label" for="inputcertificate">Certificate, Degree, Exams Completed </label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-chevron-down"></i></span>
            <input type="text" id="Certificate, Degree, Exams Completed" name="Certificate, Degree, Exams Completed" placeholder="" required />
    	</div>
    </div>
  </div>
  
     <div class="control-group">
    <label class="control-label" for="inputInstitutionContactPerson">Institution Contact Person </label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="Institution Contact Person" name="Institution Contact Persons" placeholder="" required />
    	</div>
    </div>
  </div>
	
     <div class="control-group">
    <label class="control-label" for="inputInstitutionMailingAddress">Institution Mailing Address </label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-envelope"></i></span>
            <input type="text" id="Institution Mailing Addressn" name="Institution Mailing Address" placeholder="" required />
    	</div>
    </div>
  </div>
  
  	
     <div class="control-group">
    <label class="control-label" for="inputPhoneNumber">Phone Number </label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class=" icon-chevron-down"></i></span>
            <input type="text" id="Phone Number" name="Phone Number" placeholder="Enter Phone Number" required />
    	</div>
    </div>
  </div>
  
  	
     <div class="control-group">
    <label class="control-label" for="inputFaxNumber">Fax Number </label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class=" icon-chevron-down"></i></span>
            <input type="text" id="Fax Number" name="Fax Number" placeholder="" required />
    	</div>
    </div>
  </div>
  
  	
     <div class="control-group">
    <label class="control-label" for="inputEmailAddress">Email Address </label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-envelope"></i></span>
            <input type="text" id="Email Address" name="Email Address" placeholder="Enter Email Address" required />
    	</div>
    </div>
  </div>
  
  
<!--Save and Continue Button-->
			<div id="accept_terms" align="left">		
				<div class="control-group">
					  <div class="controls">  
						<button type="submit" class="btn btn-primary" id="personal_details_submit">Save</button>
						<button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
				      </div>
				</div>
			</div>
		<!-- End of Save and Continue Button-->