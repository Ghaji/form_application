<h2>Create an Account for an administrator</h2>
<hr>
<h5 align="center">All Fields are Required</h5>
<form action="" method="POST" class="create_form form-horizontal" >
  <div class="control-group">
    <label class="control-label" for="inputEmail">Surname</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="surname" name="surname" placeholder="Enter surname" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Other Names</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="othernames" name="othernames" placeholder="Enter other names" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputStaff">Staff ID</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="staffid" name="staffid" maxlength="4" placeholder="Enter Staff ID" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Rank</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-bookmark"></i></span>
            <input type="text" id="rank" name="rank" placeholder="Enter staff's rank" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-envelope"></i></span>
            <input type="text" required id="email" name="email" placeholder="Enter e-mail" />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
      <div class="input-prepend">
      		<span class="add-on"><i class="icon-lock"></i></span>
            <input type="password" id="epassword" name="epassword" placeholder="Enter Password" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Confirm Password</label>
    <div class="controls">
      <div class="input-prepend">
      		<span class="add-on"><i class="icon-lock"></i></span>
            <input type="password" id="cepassword" name="cepassword" placeholder="Confirm Password" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Role</label>
    <div class="controls">
      <div class="input-prepend">
      		<span class="add-on"><i class="icon-bookmark"></i></span>
            <select name="role" class="input-xlarge" id="role" required >
            	<option value="">--Select A Role--</option>
                <?php
                	$database = new MYSQLDatabase();
					$roles = $database->query("SELECT * FROM admin_roles");
					
					//The key acts as values in the database
					while($row_roles = $database->fetch_array($roles)){
						echo '<option value="'.$row_roles['admin_role_id'].'">'.$row_roles['admin_role_name'].'</option>';
					}
				?>
            </select>
    	</div>
    </div>
  </div>
  <?php
  	$database = new MySQLDatabase();
  	$sql_faculty = "SELECT * FROM faculty ORDER BY faculty_name ASC";
  	$result_set = $database->query($sql_faculty);
  ?>
  <div class="department_administrator" style="display:none">
	<div class="control-group">
    <label class="control-label">Programme</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-chevron-down"></i></span>
             
                <select class="input-xlarge" name="faculty_id" id="faculty_id" onChange="get_options(this.value);" >
                    <option value="">--Select Programme--</option>
                    <?php
                    while ($row = $database -> fetch_array($result_set)) {
                        echo '<option value="' . $row['faculty_id'] . '">' . $row['faculty_name'] . '</option>';
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
                    <div id="department_id"></div>
                </select>
            </div>
        </div>
    </div>
  </div>
    
<div id="accept_terms">		
	<div class="control-group">
		  <div class="controls">  
			<button type="submit" class="btn btn-primary" id="submit" >Submit</button>
			<button type="button" onClick="document.location.href='index.php';" class="btn">Cancel</button>
	      </div>	
	</div>
</div>
</form>
  