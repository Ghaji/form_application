<?php
	$database = new MySQLDatabase();
	$session = new Session();
	$applicant_fullname = User::applicant_fullname($session->applicant_id);
	$result_details = User::find_by_id($session->applicant_id);
	
	$next_of_kin_details = NextOfKin::find_by_id($session->applicant_id);

?>
<h3 align="center">Personal Details</h3>
<hr>
<h6 align="center">All Fields are Required </h6>
<form action="" method="POST" class="personal_details form-horizontal" >
	<div class="row-fluid">
        <div class="span6">
        
        <!-- Form ID -->
                    <div class="control-group">
                        <label class="control-label" for="inputFormId">Application Number:</label> 
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span>
                                <input type="text" readonly class="input-xlarge" name="form_id" id="form_id" value="<?php echo $result_details->form_id; ?>" />
                            </div>
                        </div>
                    </div>
                    
                    <!-- Title -->
                    <?php
                        $sql_title = "SELECT * FROM title";
                        $result = $database->query($sql_title);
                    ?>
                    <div class="control-group">
                        <label class="control-label" for="inputTitle">Title</label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                                <select class="input-small" name="title_id" id="title_id" >
                                    <option value="">--Title--</option>
                                    <?php
                                    while($row = $database->fetch_array($result))
                                    {
                                        if($row['title_id'] == $result_details->title_id)
                                        {
                                            echo '<option selected="selected" value="'. $row['title_id'] .'">'.$row['title_name'].'</option>'; 
                                        }
                                        else
                                        {
                                            echo '<option value="'. $row['title_id'] .'">'.$row['title_name'].'</option>'; 
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                  
                    <!-- Full name -->
                    <div class="control-group">
                        <label class="control-label" for="inputFullname">Fullname</label> 
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span>
                                <input type="text" readonly class="input-xlarge" value="<?php if (isset($applicant_fullname)) echo $applicant_fullname; ?>" name="full_name" id="full_name" />
                            </div>
                        </div>
                    </div>
                        
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Email</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-envelope"></i></span>
                                <input type="text" readonly  class="input-xlarge" id="email" name="email" placeholder="Enter e-mail" value="<?php echo $result_details->email; ?>" />
                            </div>
                        </div>
                    </div>			
                  
                  <div class="control-group">
                    <label class="control-label" for="inputPhoneNumber">Phone Number</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="iconic-iphone"></i></span>
                            <input type="text" readonly  class="input-xlarge" id="phone" name="phone" placeholder="Enter phone number" value="<?php echo $result_details->phone_number; ?>" />
                        </div>
                    </div>
                  </div>
                
                  <div class="control-group">
                        <label class="control-label" for="inputGender">Gender</label>
                            <div class="controls">
                                <div class="input-prepend">
                                <span class="add-on"><i class="icon-chevron-down"></i></span>
                                    <select class="input-large" name="gender_id" id="gender_id" >
                                        <option value="">--Gender--</option>
                                        <?php
                                            if($result_details->gender == 'M')
                                            {
                                                echo '<option  selected="selected" value="M">Male</option>';
                                                echo '<option value="F">Female</option>';
                                            }
                                            elseif($result_details->gender == 'F')
                                            {
                                                echo '<option value="M">Male</option>';
                                                echo '<option selected="selected" value="F">Female</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="M">Male</option>';
                                                echo '<option value="F">Female</option>';
                                            }
                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                    </div>
                    
                    <!-- marital status -->
                    <?php
                        $sql_marital = "SELECT * FROM marital";
                        $result_marital = $database->query($sql_marital);
                    ?>
                    <div class="control-group">
                        <label class="control-label" for="inputMaritalStatus">Marital Status</label>
                            <div class="controls">
                                <div class="input-prepend">
                                <span class="add-on"><i class="icon-chevron-down"></i></span>
                                    <select class="input-large" name="marital_status_id" id="marital_status_id" >
                                        <option value="">--Marital Status--</option>
                                        <?php
                                        while($row = $database->fetch_array($result_marital))
                                        {
                                            if($row['marital_status_id'] == $result_details->marital_status)
                                            {		
                                                echo '<option selected="selected" value="'. $row['marital_status_id'] .'">'.$row['marital_status'].'</option>'; 
                                            }
                                            else
                                            {
                                                echo '<option value="'. $row['marital_status_id'] .'">'.$row['marital_status'].'</option>'; 
                                            }
                                        }
                                        ?>
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
                                <input type="text" class="input-medium datepicker" value="<?php if($result_details->dob!='0000-00-00') echo $result_details->dob; ?>" id="dob" name="dob" maxlength="10"  data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" />
                            </div>
                        </div>
                    </div>
                    
                    <!--Select Country-->
                    <?php
                        $sql_country = "SELECT * FROM nationality";
                        $result_country = $database->query($sql_country);
                    ?>
                        <div class="control-group">
                        <label class="control-label" for="inputCountry">Country</label>
                            <div class="controls">
                                <div class="input-prepend">
                                <span class="add-on"><i class="icon-chevron-down"></i></span>
                                    <select class="input-large" name="country_id" id="country_id"  onChange="get_options_state(this.value);"> 
                                        <option value="">--Select Country--</option>
                                        <?php
                                        while($row = $database->fetch_array($result_country))
                                        {
                                            if($row['country_id'] == $result_details->country_id)
                                            {
                                                echo '<option selected="selected" value="'. $row['country_id'] .'">'.$row['country_name'].'</option>'; 
                                            }
                                            else
                                            {
                                                echo '<option value="'. $row['country_id'] .'">'.$row['country_name'].'</option>'; 
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                    </div>
                    
                    <!--State of Origin-->
                    <div class="control-group">
                        <label class="control-label" for="inputStateOfOrigin">State of Origin</label>
                            <div class="controls">
                                <div class="input-prepend">
                                <span class="add-on"><i class="icon-chevron-down"></i></span>
                                    <select class="input-large" name="state_name" id="state_name" disabled="disabled" onChange="get_options_lga(this.value);">
                                        <option value="">--Select State of Origin--</option>
                                    </select>
                                </div>
                            </div>
                    </div>
        
        
        </div>
        <div class="span6">
        
        
        
        <!--<div class="span6 offset3">-->
        
                
                
                                
                    <!--Local Government Area-->
                    <div class="control-group">
                        <label class="control-label" for="inputLocalGovernmentArea">Local Government Area</label>
                            <div class="controls">
                                <div class="input-prepend">
                                <span class="add-on"><i class="icon-chevron-down"></i></span>
                                    <select class="input-large" name="lga_id" id="lga_id" disabled="disabled" >
                                        <option value="">--Local Government Area--</option>
                                    </select>
                                    <input type="hidden" id="lga_hidden" value="<?php echo $result_details->lga_id; ?>"/>
                                </div>
                            </div>
                    </div>
                
                    
                    <!-- Religion -->
                    <?php
                        $sql_religion = "SELECT * FROM religion";
                        $result_religion = $database->query($sql_religion);
                    ?>
                    <div class="control-group">
                        <label class="control-label" for="inputReligion">Religion</label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-down"></i></span>
                                <select class="input-large" name="religion_id" id="religion_id" >
                                    <option value="">--Religion--</option>
                                    <?php
                                        while($row = $database->fetch_array($result_religion))
                                        {		
                                            if($row['religion_id'] == $result_details->religion_id)
                                            {
                                                echo '<option  selected="selected"value="'. $row['religion_id'] .'">'.$row['religion_name'].'</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="'. $row['religion_id'] .'">'.$row['religion_name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Address -->
                    <div class="control-group">
                        <label class="control-label" for="inputAdress">Address</label> 
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-home"></i></span>
                                <textarea rows="4" class="input-xlarge" id="address" name="address"><?php echo $result_details->address;?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!--Next of Kin Name-->
                    <div class="control-group">
                        <label class="control-label" for="inputNextOfKinName"> Next of Kin Name</label> 
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-user"></i></span>
                                <input type="text" class="input-xlarge" value="<?php if(isset($next_of_kin_details->next_of_kin_name)) echo $next_of_kin_details->next_of_kin_name; ?>" name="next_kin_name" id="next_kin_name" placeholder="Surname First Name Middle Name" />
                            </div>
                        </div>
                    </div>
                    
                  <!--Next of Kin Relationship-->
                  <div class="control-group">
                    <label class="control-label" for="inputNextOfKinNumber">Next of Kin Relationship</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                            <input type="text" class="input-xlarge" value="<?php if(isset($next_of_kin_details->next_of_kin_relationship)) echo $next_of_kin_details->next_of_kin_relationship; ?>" id="next_of_kin_relationship" name="next_of_kin_relationship" maxlength="11" placeholder="Next of Kin Relationship"  />
                        </div>
                    </div>
                  </div>
                        
                
                  <!--Next of Kin Phone Number-->
                  <div class="control-group">
                    <label class="control-label" for="inputNextOfKinNumber">Next of Kin Number</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="iconic-iphone"></i></span>
                            <input type="text" class="input-xlarge" value="<?php if(isset($next_of_kin_details->next_of_kin_number)) echo $next_of_kin_details->next_of_kin_number; ?>" id="next_of_kin_number" name="next_of_kin_number" maxlength="11" placeholder="Next of kin phone number"  />
                        </div>
                    </div>
                  </div>
                
                  <!--Next of Kin Address-->
                    <div class="control-group">
                        <label class="control-label" for="inputNextOfKinAddress">Next of Kin Address</label> 
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-home"></i></span>
                                <textarea rows="4" class="input-xlarge" id="next_of_kin_address" name="next_of_kin_address"><?php if(isset($next_of_kin_details->next_of_kin_address)) echo $next_of_kin_details->next_of_kin_address; ?></textarea>
                            </div>
                        </div>
                    </div>
        </div>    
	</div>
    <br>
    <hr>
    <!--Save and Continue Button-->
    <div id="accept_terms" align="center">		
        <div class="control-group">
              <div class="controls">  
                <button type="submit" class="btn btn-primary" id="personal_details_submit">Save</button>
                <button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
              </div>
        </div>
    </div>
    <!-- End of Save and Continue Button-->	
</form>